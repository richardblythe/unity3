<?php

declare (strict_types=1);
namespace Unity3_Vendor;

function foo() : bool
{
    return \true;
}
if (!\function_exists('Unity3_Vendor\\bar')) {
    function bar() : bool
    {
        return \true;
    }
}
if (\function_exists('Unity3_Vendor\\baz')) {
    baz();
}
