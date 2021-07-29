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
namespace Unity3_Vendor\Humbug\PhpScoper;

use Unity3_Vendor\Humbug\PhpScoper\PhpParser\TraverserFactory;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\Composer\InstalledPackagesScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\Composer\JsonFileScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\NullScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\PatchScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\PhpScoper;
use Unity3_Vendor\Humbug\PhpScoper\Scoper\SymfonyScoper;
use Unity3_Vendor\PhpParser\Lexer;
use Unity3_Vendor\PhpParser\Parser;
use Unity3_Vendor\PhpParser\ParserFactory;
final class Container
{
    private $parser;
    private $reflector;
    private $scoper;
    public function getScoper() : Scoper
    {
        if (null === $this->scoper) {
            $this->scoper = new PatchScoper(new PhpScoper($this->getParser(), new JsonFileScoper(new InstalledPackagesScoper(new SymfonyScoper(new NullScoper()))), new TraverserFactory($this->getReflector())));
        }
        return $this->scoper;
    }
    public function getParser() : Parser
    {
        if (null === $this->parser) {
            $this->parser = (new ParserFactory())->create(ParserFactory::ONLY_PHP7, new Lexer());
        }
        return $this->parser;
    }
    public function getReflector() : Reflector
    {
        if (null === $this->reflector) {
            $this->reflector = new Reflector();
        }
        return $this->reflector;
    }
}
