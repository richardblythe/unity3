<?php

declare (strict_types=1);
namespace Unity3_Vendor;

require_once __DIR__ . '/../vendor/autoload.php';
use Unity3_Vendor\Set015\Greeter;
$c = new Pimple\Container(['hello' => 'Hello world!']);
echo (new Greeter())->greet($c) . \PHP_EOL;
