<?php


namespace HKwak\PhpGenTests\CodeStreams;


use HKwak\PhpGen\CodeStreams\PhpCodeStream;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class PhpCodeStreamTest extends TestCase
{
    public function dataForGetTab(): array
    {
        return [
            '1. no tabs' => [
                'number' => 0,
                'expected' => '',
            ],
            '2. no tabs' => [
                'number' => 1,
                'expected' => '    ',
            ],
        ];
    }

    /**
     * @param int $number
     * @param string $expected
     *
     * @dataProvider dataForGetTab
     * @throws \ReflectionException
     */
    public function testTab(int $number, string $expected)
    {
        $stream = new PhpCodeStream();

        $class = new ReflectionClass(PhpCodeStream::class);
        $method = $class->getMethod('getTab');
        $method->setAccessible(true);
        $result = $method->invokeArgs($stream, ['number' => $number]);
        $this->assertEquals($expected, $result);
    }
}
