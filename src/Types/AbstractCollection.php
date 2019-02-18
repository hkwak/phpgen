<?php


namespace Hkwak\Types;


use RQuadling\TypedArray\TypedArray;

abstract class AbstractCollection extends TypedArray
{
    /**
     * Finding the first element in the Array, for which $callback returns true
     *
     * @param callable $callback
     *
     * @return mixed Element Found in the Array or null
     */
    public function find(callable $callback)
    {
        foreach ($this as $element) {
            if ($callback($element)) {
                return $element;
            }
        }

        return null;
    }
}
