<?php

declare (strict_types=1);
/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor;

use Unity3_Vendor\Humbug\PhpScoper\PhpParser\Node\FullyQualifiedFactory;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\NamespaceStmt\NamespaceStmtCollection;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver\FullyQualifiedNameResolver;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\UseStmt\UseStmtCollection;
use Unity3_Vendor\Humbug\PhpScoper\Reflector;
use Unity3_Vendor\Humbug\PhpScoper\Whitelist;
use Unity3_Vendor\PhpParser\Node;
use Unity3_Vendor\PhpParser\Node\Expr\ArrowFunction;
use Unity3_Vendor\PhpParser\Node\Expr\ClassConstFetch;
use Unity3_Vendor\PhpParser\Node\Expr\ConstFetch;
use Unity3_Vendor\PhpParser\Node\Expr\FuncCall;
use Unity3_Vendor\PhpParser\Node\Expr\Instanceof_;
use Unity3_Vendor\PhpParser\Node\Expr\New_;
use Unity3_Vendor\PhpParser\Node\Expr\StaticCall;
use Unity3_Vendor\PhpParser\Node\Expr\StaticPropertyFetch;
use Unity3_Vendor\PhpParser\Node\Name;
use Unity3_Vendor\PhpParser\Node\Name\FullyQualified;
use Unity3_Vendor\PhpParser\Node\NullableType;
use Unity3_Vendor\PhpParser\Node\Param;
use Unity3_Vendor\PhpParser\Node\Stmt\Catch_;
use Unity3_Vendor\PhpParser\Node\Stmt\Class_;
use Unity3_Vendor\PhpParser\Node\Stmt\ClassMethod;
use Unity3_Vendor\PhpParser\Node\Stmt\Function_;
use Unity3_Vendor\PhpParser\Node\Stmt\Interface_;
use Unity3_Vendor\PhpParser\Node\Stmt\Property;
use Unity3_Vendor\PhpParser\NodeVisitorAbstract;
use function array_merge;
use function count;
use function in_array;
/**
 * Prefixes names when appropriate.
 *
 * ```
 * new Foo\Bar();
 * ```.
 *
 * =>
 *
 * ```
 * new \Humbug\Foo\Bar();
 * ```
 *
 * @private
 */
final class NameStmtPrefixer extends NodeVisitorAbstract
{
    public const PHP_FUNCTION_KEYWORDS = ['self', 'static', 'parent'];
    private $prefix;
    private $whitelist;
    private $namespaceStatements;
    private $useStatements;
    private $nameResolver;
    private $reflector;
    public function __construct(string $prefix, Whitelist $whitelist, NamespaceStmtCollection $namespaceStatements, UseStmtCollection $useStatements, FullyQualifiedNameResolver $nameResolver, Reflector $reflector)
    {
        $this->prefix = $prefix;
        $this->whitelist = $whitelist;
        $this->namespaceStatements = $namespaceStatements;
        $this->useStatements = $useStatements;
        $this->nameResolver = $nameResolver;
        $this->reflector = $reflector;
    }
    /**
     * @inheritdoc
     */
    public function enterNode(Node $node) : Node
    {
        return $node instanceof Name && ParentNodeAppender::hasParent($node) ? $this->prefixName($node) : $node;
    }
    private function prefixName(Name $name) : Node
    {
        $parentNode = ParentNodeAppender::getParent($name);
        if ($parentNode instanceof NullableType) {
            if (\false === ParentNodeAppender::hasParent($parentNode)) {
                return $name;
            }
            $parentNode = ParentNodeAppender::getParent($parentNode);
        }
        if (\false === ($parentNode instanceof ArrowFunction || $parentNode instanceof Catch_ || $parentNode instanceof ConstFetch || $parentNode instanceof Class_ || $parentNode instanceof ClassConstFetch || $parentNode instanceof ClassMethod || $parentNode instanceof FuncCall || $parentNode instanceof Function_ || $parentNode instanceof Instanceof_ || $parentNode instanceof Interface_ || $parentNode instanceof New_ || $parentNode instanceof Param || $parentNode instanceof Property || $parentNode instanceof StaticCall || $parentNode instanceof StaticPropertyFetch)) {
            return $name;
        }
        if (($parentNode instanceof Catch_ || $parentNode instanceof ClassConstFetch || $parentNode instanceof New_ || $parentNode instanceof FuncCall || $parentNode instanceof Instanceof_ || $parentNode instanceof Param || $parentNode instanceof StaticCall || $parentNode instanceof StaticPropertyFetch) && in_array((string) $name, self::PHP_FUNCTION_KEYWORDS, \true)) {
            return $name;
        }
        if ($parentNode instanceof ConstFetch && 'null' === (string) $name) {
            return $name;
        }
        $resolvedName = $this->nameResolver->resolveName($name)->getName();
        // Do not prefix if there is a matching use statement.
        $useStatement = $this->useStatements->findStatementForNode($this->namespaceStatements->findNamespaceForNode($name), $name);
        if ($useStatement !== null && !$name instanceof FullyQualified && self::array_starts_with($resolvedName->parts, $useStatement->parts) && !($parentNode instanceof ConstFetch && ($this->whitelist->isGlobalWhitelistedConstant($resolvedName->toString()) || $this->whitelist->isSymbolWhitelisted($resolvedName->toString(), \true))) && !($useStatement->getAttribute('parent') && $useStatement->getAttribute('parent')->alias !== null && $this->whitelist->isSymbolWhitelisted($useStatement->toString())) && $resolvedName->parts !== ['Isolated', 'Symfony', 'Component', 'Finder', 'Finder']) {
            return $name;
        }
        if ($this->prefix === $resolvedName->getFirst() || $this->whitelist->belongsToWhitelistedNamespace((string) $resolvedName)) {
            return $resolvedName;
        }
        // Do not prefix if the Name is inside of the current namespace
        $namespace = $this->namespaceStatements->getCurrentNamespaceName();
        if ($namespace !== null && array_merge($namespace->parts, $name->parts) === $resolvedName->parts || $namespace === null && $name->parts === $resolvedName->parts && !$name instanceof FullyQualified && !$parentNode instanceof ConstFetch && !$this->whitelist->isSymbolWhitelisted($resolvedName->toString()) && !$this->reflector->isFunctionInternal($resolvedName->toString()) && !$this->reflector->isClassInternal($resolvedName->toString())) {
            return $name;
        }
        // Check if the class can be prefixed
        if (\false === ($parentNode instanceof ConstFetch || $parentNode instanceof FuncCall) && $this->reflector->isClassInternal($resolvedName->toString())) {
            return $resolvedName;
        }
        if ($parentNode instanceof ConstFetch) {
            if ($this->whitelist->isSymbolWhitelisted($resolvedName->toString(), \true)) {
                return $resolvedName;
            }
            if ($this->reflector->isConstantInternal($resolvedName->toString())) {
                return new FullyQualified($resolvedName->toString(), $resolvedName->getAttributes());
            }
            // Constants have an autoloading fallback so we cannot prefix them when the name is ambiguous
            // See https://wiki.php.net/rfc/fallback-to-root-scope-deprecation
            if (\false === $resolvedName instanceof FullyQualified) {
                return $resolvedName;
            }
            if ($this->whitelist->isGlobalWhitelistedConstant((string) $resolvedName)) {
                // Unlike classes & functions, whitelisted are not prefixed with aliases registered in scoper-autoload.php
                return new FullyQualified($resolvedName->toString(), $resolvedName->getAttributes());
            }
            // Continue
        }
        // Functions have a fallback autoloading so we cannot prefix them when the name is ambiguous
        // See https://wiki.php.net/rfc/fallback-to-root-scope-deprecation
        if ($parentNode instanceof FuncCall) {
            if ($this->reflector->isFunctionInternal($resolvedName->toString())) {
                return new FullyQualified($resolvedName->toString(), $resolvedName->getAttributes());
            }
            if (\false === $resolvedName instanceof FullyQualified) {
                return $resolvedName;
            }
        }
        if ($parentNode instanceof ClassMethod && $resolvedName->isSpecialClassName()) {
            return $name;
        }
        return FullyQualifiedFactory::concat($this->prefix, $resolvedName->toString(), $resolvedName->getAttributes());
    }
    private static function array_starts_with($arr, $prefix) : bool
    {
        $prefixLength = count($prefix);
        for ($i = 0; $i < $prefixLength; ++$i) {
            if ($arr[$i] !== $prefix[$i]) {
                return \false;
            }
        }
        return \true;
    }
}
