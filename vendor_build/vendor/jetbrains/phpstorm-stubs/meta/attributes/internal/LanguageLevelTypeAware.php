<?php

namespace Unity3_Vendor\JetBrains\PhpStorm\Internal;

use Attribute;
use Unity3_Vendor\JetBrains\PhpStorm\Deprecated;
use Unity3_Vendor\JetBrains\PhpStorm\ExpectedValues;
/**
 * For PhpStorm internal use only
 * @since 8.0
 * @internal
 */
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_PARAMETER)]
class LanguageLevelTypeAware
{
    public function __construct(array $languageLevelTypeMap, string $default)
    {
    }
}
