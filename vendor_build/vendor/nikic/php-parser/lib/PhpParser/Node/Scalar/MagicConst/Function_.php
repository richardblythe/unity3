<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser\Node\Scalar\MagicConst;

use Unity3_Vendor\PhpParser\Node\Scalar\MagicConst;
class Function_ extends MagicConst
{
    public function getName() : string
    {
        return '__FUNCTION__';
    }
    public function getType() : string
    {
        return 'Scalar_MagicConst_Function';
    }
}
