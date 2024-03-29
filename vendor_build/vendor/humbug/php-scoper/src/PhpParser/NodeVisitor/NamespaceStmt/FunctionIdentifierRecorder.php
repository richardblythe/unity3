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
namespace Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\NamespaceStmt;

use Unity3_Vendor\Humbug\PhpScoper\PhpParser\Node\FullyQualifiedFactory;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\ParentNodeAppender;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver\FullyQualifiedNameResolver;
use Unity3_Vendor\Humbug\PhpScoper\Reflector;
use Unity3_Vendor\Humbug\PhpScoper\Whitelist;
use Unity3_Vendor\PhpParser\Node;
use Unity3_Vendor\PhpParser\Node\Arg;
use Unity3_Vendor\PhpParser\Node\Expr\FuncCall;
use Unity3_Vendor\PhpParser\Node\Identifier;
use Unity3_Vendor\PhpParser\Node\Name;
use Unity3_Vendor\PhpParser\Node\Name\FullyQualified;
use Unity3_Vendor\PhpParser\Node\Scalar\String_;
use Unity3_Vendor\PhpParser\Node\Stmt\Function_;
use Unity3_Vendor\PhpParser\NodeVisitorAbstract;
/**
 * Records the user functions registered in the global namespace which have been whitelisted and whitelisted functions.
 *
 * @private
 */
final class FunctionIdentifierRecorder extends NodeVisitorAbstract
{
    private $prefix;
    private $nameResolver;
    private $whitelist;
    private $reflector;
    public function __construct(string $prefix, FullyQualifiedNameResolver $nameResolver, Whitelist $whitelist, Reflector $reflector)
    {
        $this->prefix = $prefix;
        $this->nameResolver = $nameResolver;
        $this->whitelist = $whitelist;
        $this->reflector = $reflector;
    }
    /**
     * @inheritdoc
     */
    public function enterNode(Node $node) : Node
    {
        if (\false === ($node instanceof Identifier || $node instanceof Name || $node instanceof String_) || \false === ParentNodeAppender::hasParent($node)) {
            return $node;
        }
        if (null === ($resolvedName = $this->retrieveResolvedName($node))) {
            return $node;
        }
        if (\false === $this->reflector->isFunctionInternal((string) $resolvedName) && ($this->whitelist->isGlobalWhitelistedFunction((string) $resolvedName) || $this->whitelist->isSymbolWhitelisted((string) $resolvedName))) {
            $this->whitelist->recordWhitelistedFunction($resolvedName, FullyQualifiedFactory::concat($this->prefix, $resolvedName));
        }
        return $node;
    }
    private function retrieveResolvedName(Node $node) : ?FullyQualified
    {
        if ($node instanceof Identifier) {
            return $this->retrieveResolvedNameForIdentifier($node);
        }
        if ($node instanceof Name) {
            return $this->retrieveResolvedNameForFuncCall($node);
        }
        if ($node instanceof String_) {
            return $this->retrieveResolvedNameForString($node);
        }
        return null;
    }
    private function retrieveResolvedNameForIdentifier(Identifier $node) : ?FullyQualified
    {
        $parent = ParentNodeAppender::getParent($node);
        if (\false === $parent instanceof Function_ || $node === $parent->returnType) {
            return null;
        }
        $resolvedName = $this->nameResolver->resolveName($node)->getName();
        return $resolvedName instanceof FullyQualified ? $resolvedName : null;
    }
    private function retrieveResolvedNameForFuncCall(Name $node) : ?FullyQualified
    {
        $parent = ParentNodeAppender::getParent($node);
        if (\false === $parent instanceof FuncCall) {
            return null;
        }
        $resolvedName = $this->nameResolver->resolveName($node)->getName();
        return $resolvedName instanceof FullyQualified ? $resolvedName : null;
    }
    private function retrieveResolvedNameForString(String_ $node) : ?FullyQualified
    {
        $stringParent = ParentNodeAppender::getParent($node);
        if (\false === $stringParent instanceof Arg) {
            return null;
        }
        $argParent = ParentNodeAppender::getParent($stringParent);
        if (\false === $argParent instanceof FuncCall || \false === $argParent->name instanceof FullyQualified || 'function_exists' !== (string) $argParent->name) {
            return null;
        }
        $resolvedName = $this->nameResolver->resolveName($node)->getName();
        return $resolvedName instanceof FullyQualified ? $resolvedName : null;
    }
}
