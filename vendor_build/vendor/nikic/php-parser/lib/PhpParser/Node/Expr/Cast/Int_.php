<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser\Node\Expr\Cast;

use Unity3_Vendor\PhpParser\Node\Expr\Cast;
class Int_ extends Cast
{
    public function getType() : string
    {
        return 'Expr_Cast_Int';
    }
}
