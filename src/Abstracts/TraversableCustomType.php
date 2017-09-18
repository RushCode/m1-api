<?php

namespace Leocata\M1\Types\Custom;

use Leocata\M1\Abstracts\CustomType;

abstract class TraversableCustomType extends CustomType implements \IteratorAggregate
{
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->data);
    }
}