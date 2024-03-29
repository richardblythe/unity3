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
use Unity3_Vendor\Humbug\PhpScoper\PhpParser\NodeVisitor\Resolver\FullyQualifiedNameResolver;
use Unity3_Vendor\Humbug\PhpScoper\Whitelist;
use Unity3_Vendor\PhpParser\Node;
use Unity3_Vendor\PhpParser\Node\Identifier;
use Unity3_Vendor\PhpParser\Node\Name\FullyQualified;
use Unity3_Vendor\PhpParser\Node\Stmt\ClassLike;
use Unity3_Vendor\PhpParser\Node\Stmt\Trait_;
use Unity3_Vendor\PhpParser\NodeVisitorAbstract;
/**
 * Records the user classes registered in the global namespace which have been whitelisted and whitelisted classes.
 *
 * @private
 */
final class ClassIdentifierRecorder extends NodeVisitorAbstract
{
    private $prefix;
    private $nameResolver;
    private $whitelist;
    public function __construct(string $prefix, FullyQualifiedNameResolver $nameResolver, Whitelist $whitelist)
    {
        $this->prefix = $prefix;
        $this->nameResolver = $nameResolver;
        $this->whitelist = $whitelist;
    }
    /**
     * @inheritdoc
     */
    public function enterNode(Node $node) : Node
    {
        if (\false === $node instanceof Identifier || \false === ParentNodeAppender::hasParent($node)) {
            return $node;
        }
        $parent = ParentNodeAppender::getParent($node);
        if (\false === $parent instanceof ClassLike || $parent instanceof Trait_) {
            return $node;
        }
        /** @var ClassLike $parent */
        if (null === $parent->name) {
            return $node;
        }
        /** @var Identifier $node */
        $resolvedName = $this->nameResolver->resolveName($node)->getName();
        if (\false === $resolvedName instanceof FullyQualified) {
            return $node;
        }
        /** @var FullyQualified $resolvedName */
        if ($this->whitelist->isGlobalWhitelistedClass((string) $resolvedName) || $this->whitelist->isSymbolWhitelisted((string) $resolvedName)) {
            $this->whitelist->recordWhitelistedClass($resolvedName, FullyQualifiedFactory::concat($this->prefix, $resolvedName));
        }
        return $node;
    }
}
