<?php

declare (strict_types=1);
namespace Unity3_Vendor\Acme;

final class Foo
{
    public function __invoke()
    {
        echo 'OK';
    }
}
