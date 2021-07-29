<?php

namespace Unity3_Vendor\Aws\Api;

/**
 * Base class representing a modeled shape.
 */
class Shape extends AbstractModel
{
    /**
     * Get a concrete shape for the given definition.
     *
     * @param array    $definition
     * @param ShapeMap $shapeMap
     *
     * @return mixed
     * @throws \RuntimeException if the type is invalid
     */
    public static function create(array $definition, ShapeMap $shapeMap)
    {
        static $map = ['structure' => 'Unity3_Vendor\\Aws\\Api\\StructureShape', 'map' => 'Unity3_Vendor\\Aws\\Api\\MapShape', 'list' => 'Unity3_Vendor\\Aws\\Api\\ListShape', 'timestamp' => 'Unity3_Vendor\\Aws\\Api\\TimestampShape', 'integer' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'double' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'float' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'long' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'string' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'byte' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'character' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'blob' => 'Unity3_Vendor\\Aws\\Api\\Shape', 'boolean' => 'Unity3_Vendor\\Aws\\Api\\Shape'];
        if (isset($definition['shape'])) {
            return $shapeMap->resolve($definition);
        }
        if (!isset($map[$definition['type']])) {
            throw new \RuntimeException('Invalid type: ' . \print_r($definition, \true));
        }
        $type = $map[$definition['type']];
        return new $type($definition, $shapeMap);
    }
    /**
     * Get the type of the shape
     *
     * @return string
     */
    public function getType()
    {
        return $this->definition['type'];
    }
    /**
     * Get the name of the shape
     *
     * @return string
     */
    public function getName()
    {
        return $this->definition['name'];
    }
}
