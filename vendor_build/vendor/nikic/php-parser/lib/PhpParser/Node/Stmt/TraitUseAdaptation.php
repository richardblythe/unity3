<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser\Node\Stmt;

use Unity3_Vendor\PhpParser\Node;
abstract class TraitUseAdaptation extends Node\Stmt
{
    /** @var Node\Name|null Trait name */
    public $trait;
    /** @var Node\Identifier Method name */
    public $method;
}
