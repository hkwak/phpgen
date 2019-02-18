<?php


namespace HKwak\PhpGen\Types;


class StringCollection extends \ArrayObject
{
    public function offsetSet($index, $newval)
    {
        if (!is_string($newval)) {
            throw new \InvalidArgumentException('Parameter $newval is expected to be a string');
        }
        parent::offsetSet($index, $newval);
    }

    /**
     * TypedArray constructor.
     *
     * @param array|object $input The input parameter accepts an array or an Object.
     * @param int $flags Flags to control the behaviour of the ArrayObject object.
     * @param string $iteratorClass
     */
    public function __construct($input = [], $flags = 0, $iteratorClass = 'ArrayIterator')
    {
        foreach ($input as $index => $element) {
            if (is_string($element)) {
                $input[$index] = $element;
            } else {
                throw new \InvalidArgumentException('Parameter $input should only contain string elements');
            }
        }
        parent::__construct($input, $flags, $iteratorClass);
    }

    public function implode(string $glue): string
    {
        return implode($glue, $this->getArrayCopy());
    }
}
