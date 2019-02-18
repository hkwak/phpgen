<?php


namespace HKwak\PhpGenTests\Generators\Fixtures;


use HKwak\PhpGen\Generators\AbstractGenerator;

class ConcreteGenerator extends AbstractGenerator
{
    public function quoteValue(string $value, string $type): string
    {
        return parent::quoteValue($value, $type);
    }
}
