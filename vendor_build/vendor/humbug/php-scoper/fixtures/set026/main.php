<?php

declare (strict_types=1);
namespace Unity3_Vendor;

use Unity3_Vendor\Acme\Foo as FooClass;
use const Unity3_Vendor\Acme\FOO as FOO_CONST;
use function Unity3_Vendor\Acme\foo as foo_func;
if (\file_exists($autoload = __DIR__ . '/vendor/scoper-autoload.php')) {
    require_once $autoload;
} else {
    require_once __DIR__ . '/vendor/autoload.php';
}
(new FooClass())();
foo_func();
echo FOO_CONST . \PHP_EOL;
