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
namespace Unity3_Vendor\Humbug\PhpScoper\Scoper;

use Unity3_Vendor\Humbug\PhpScoper\Scoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\Symfony\XmlScoper as SymfonyXmlScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\Symfony\YamlScoper as SymfonyYamlScoper;
use Unity3_Vendor\Humbug\PhpScoper\Whitelist;
use Unity3_Vendor\PhpParser\Error as PhpParserError;
use function func_get_args;
/**
 * Scopes the Symfony configuration related files.
 */
final class SymfonyScoper implements Scoper
{
    private $decoratedScoper;
    public function __construct(Scoper $decoratedScoper)
    {
        $this->decoratedScoper = new SymfonyXmlScoper(new SymfonyYamlScoper($decoratedScoper));
    }
    /**
     * Scopes PHP files.
     *
     * {@inheritdoc}
     *
     * @throws PhpParserError
     */
    public function scope(string $filePath, string $contents, string $prefix, array $patchers, Whitelist $whitelist) : string
    {
        return $this->decoratedScoper->scope(...func_get_args());
    }
}
