<?php


namespace HKwak\PhpGen\Generators;


abstract class AbstractGenerator implements GeneratorInterface
{
    /**
     * @param string $value
     * @param string $type
     *
     * @return string
     */
    protected function quoteValue(string $value, string $type): string
    {
        if ($type === 'string' && $value !== 'null') {
            return '\''.$value.'\'';
        }

        return $value;
    }
}