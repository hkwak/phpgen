<?php


namespace HKwak\Generators;


abstract class AbstractGenerator implements GeneratorInterface
{
    protected function quoteValue(string $value, string $type)
    {
        if ($type === 'string' && $value !== 'null') {
            return '\''.$value.'\'';
        }

        return $value;
    }
}