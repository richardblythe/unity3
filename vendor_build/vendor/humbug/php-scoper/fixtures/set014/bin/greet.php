<?php

declare (strict_types=1);
namespace Unity3_Vendor;

require_once __DIR__ . '/../vendor/autoload.php';
use Unity3_Vendor\Set014\Greeter;
echo (new Greeter())->greet() . \PHP_EOL;
