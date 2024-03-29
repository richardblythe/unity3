<?php

namespace Unity3_Vendor\JetBrains\PhpStorm;

use Attribute;
/**
 * The attribute marks the function that has no impact on the program state or passed parameters used after the function execution.
 * This means that a function call that resolves to such a function can be safely removed if the execution result is not used in code afterwards.
 *
 * @since 8.0
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
class Pure
{
}
