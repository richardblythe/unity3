<?php

namespace Unity3_Vendor;

use Unity3_Vendor\JetBrains\PhpStorm\Pure;
/**
 * @since 8.0
 */
class ReflectionUnionType extends \ReflectionType
{
    /**
     * Get list of named types of union type
     *
     * @return ReflectionNamedType[]
     */
    #[Pure]
    public function getTypes()
    {
    }
}
/**
 * @since 8.0
 */
\class_alias('Unity3_Vendor\\ReflectionUnionType', 'ReflectionUnionType', \false);
