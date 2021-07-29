<?php

declare (strict_types=1);
namespace Unity3_Vendor\Set011;

use Generator;
class Greeter
{
    private $words;
    /**
     * @param string[] $words
     */
    public function __construct(array $words)
    {
        $this->words = $words;
    }
    /**
     * @return Generator|string
     */
    public function greet()
    {
        foreach ($this->words as $word) {
            (yield $word . ' world!');
        }
    }
}
