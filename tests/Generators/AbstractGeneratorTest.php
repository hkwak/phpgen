<?php


namespace HKwak\PhpGenTests\Generators;


use HKwak\PhpGenTests\Generators\Fixtures\ConcreteGenerator;
use PHPUnit\Framework\TestCase;

class AbstractGeneratorTest extends TestCase
{
    public function getTestDataForQuoteValue(): array
    {
        return [
            '1. not null ' => [
                'value' => 'test',
                'type' => 'string',
                'expected' => '\'test\'',
            ],
            '2. null for string ' => [
                'value' => 'null',
                'type' => 'string',
                'expected' => 'null',
            ],
            '3. null for non-string' => [
                'value' => 'null',
                'type' => 'int',
                'expected' => 'null',
            ],
            '4. non-null for non-string' => [
                'value' => 'test',
                'type' => 'int',
                'expected' => 'test',
            ],
        ];
    }

    /**
     * @param string $value
     * @param string $type
     * @param $expected
     *
     * @dataProvider getTestDataForQuoteValue
     */
    public function testQuoteValue(string $value, string $type, $expected)
    {
        $generator = new ConcreteGenerator();

        $this->assertEquals($expected, $generator->quoteValue($value, $type));
    }
}
