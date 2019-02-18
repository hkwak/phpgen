<?php


namespace HKwak\PhpGen\Types;


class StringCollection extends AbstractCollection
{
    const ARRAY_TYPE = 'string';

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
