<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser\Node\Expr\AssignOp;

use Unity3_Vendor\PhpParser\Node\Expr\AssignOp;
class Plus extends AssignOp
{
    public function getType() : string
    {
        return 'Expr_AssignOp_Plus';
    }
}
