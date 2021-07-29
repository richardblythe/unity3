<?php

namespace Unity3_Vendor\Aws\Api\Serializer;

use Unity3_Vendor\Aws\Api\Shape;
use Unity3_Vendor\Aws\Api\ListShape;
/**
 * @internal
 */
class Ec2ParamBuilder extends QueryParamBuilder
{
    protected function queryName(Shape $shape, $default = null)
    {
        return ($shape['queryName'] ?: \ucfirst($shape['locationName'])) ?: $default;
    }
    protected function isFlat(Shape $shape)
    {
        return \false;
    }
    protected function format_list(ListShape $shape, array $value, $prefix, &$query)
    {
        // Handle empty list serialization
        if (!$value) {
            $query[$prefix] = \false;
        } else {
            $items = $shape->getMember();
            foreach ($value as $k => $v) {
                $this->format($items, $v, $prefix . '.' . ($k + 1), $query);
            }
        }
    }
}
