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
namespace Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver;

use Unity3_Vendor\Humbug\PhpScoper\PhpParser\Node\FullyQualifiedFactory;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\Node\NamedIdentifier;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\NamespaceStmt\NamespaceStmtCollection;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\NameStmtPrefixer;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\ParentNodeAppender;
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\UseStmt\UseStmtCollection;
use Unity3_Vendor\PhpParser\Node;
use Unity3_Vendor\PhpParser\Node\Expr\ConstFetch;
use Unity3_Vendor\PhpParser\Node\Expr\FuncCall;
use Unity3_Vendor\PhpParser\Node\Identifier;
use Unity3_Vendor\PhpParser\Node\Name;
use Unity3_Vendor\PhpParser\Node\Name\FullyQualified;
use Unity3_Vendor\PhpParser\Node\Scalar\String_;
use function count;
use function in_array;
use function ltrim;
/**
 * Attempts to resolve the node name into a fully qualified node. Returns a valid (non fully-qualified) name node on
 * failure.
 *
 * @private
 */
final class FullyQualifiedNameResolver
{
    private $namespaceStatements;
    private $useStatements;
    public function __construct(NamespaceStmtCollection $namespaceStatements, UseStmtCollection $useStatements)
    {
        $this->namespaceStatements = $namespaceStatements;
        $this->useStatements = $useStatements;
    }
    /**
     * @param Name|String_|Identifier $node
     */
    public function resolveName(Node $node) : ResolvedValue
    {
        if ($node instanceof FullyQualified) {
            return new ResolvedValue($node, null, null);
        }
        if ($node instanceof String_) {
            return $this->resolveStringName($node);
        }
        if ($node instanceof Identifier) {
            $node = NamedIdentifier::create($node);
        }
        $namespaceName = $this->namespaceStatements->findNamespaceForNode($node);
        $useName = $this->useStatements->findStatementForNode($namespaceName, $node);
        return new ResolvedValue($this->resolveNodeName($node, $namespaceName, $useName), $namespaceName, $useName);
    }
    private function resolveNodeName(Name $name, ?Name $namespace, ?Name $use) : Name
    {
        if (null !== $use) {
            return FullyQualifiedFactory::concat($use, $name->slice(1), $name->getAttributes());
        }
        if (null === $namespace) {
            return new FullyQualified($name, $name->getAttributes());
        }
        if (in_array((string) $name, NameStmtPrefixer::PHP_FUNCTION_KEYWORDS, \true)) {
            return $name;
        }
        $parentNode = ParentNodeAppender::getParent($name);
        if (($parentNode instanceof ConstFetch || $parentNode instanceof FuncCall) && 1 === count($name->parts)) {
            // Ambiguous name, cannot determine the FQ name
            return $name;
        }
        return FullyQualifiedFactory::concat($namespace, $name, $name->getAttributes());
    }
    private function resolveStringName(String_ $node) : ResolvedValue
    {
        $name = new FullyQualified(ltrim($node->value, '\\'));
        $deducedNamespaceName = $name->slice(0, -1);
        $namespaceName = null;
        if (null !== $deducedNamespaceName) {
            $namespaceName = $this->namespaceStatements->findNamespaceByName($deducedNamespaceName->toString());
        }
        return new ResolvedValue($name, $namespaceName, null);
    }
}
