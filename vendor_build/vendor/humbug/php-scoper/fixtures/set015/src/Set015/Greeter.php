<?php

declare (strict_types=1);
namespace Unity3_Vendor\Set015;

use Unity3_Vendor\Pimple\Container;
class Greeter
{
    public function greet(Container $c) : string
    {
        return $c['hello'];
    }
}
