<?php

declare (strict_types=1);
namespace Unity3_Vendor\PhpParser;

interface Builder
{
    /**
     * Returns the built node.
     *
     * @return Node The built node
     */
    public function getNode() : Node;
}
