<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser\ErrorHandler;

use Unity3_Vendor\PhpParser\Error;
use Unity3_Vendor\PhpParser\ErrorHandler;
/**
 * Error handler that handles all errors by throwing them.
 *
 * This is the default strategy used by all components.
 */
class Throwing implements ErrorHandler
{
    public function handleError(Error $error)
    {
        throw $error;
    }
}
