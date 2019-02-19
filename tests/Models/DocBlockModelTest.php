<?php


namespace HKwak\PhpGenTests\Models;


use HKwak\PhpGen\Models\DocBlockModel;
use PHPUnit\Framework\TestCase;

class DocBlockModelTest extends TestCase
{
    public function dataForCreation(): array
    {
        return [
            '1. both nulls' => [
                'comment' => null,
                'annotation' => null,
            ],
            '2. some comment' => [
                'comment' => 'test comment',
                'annotation' => null,
            ],
            '3. some annotation' => [
                'comment' => null,
                'annotation' => 'string|null',
            ],
        ];
    }

    /**
     * @param string|null $comment
     * @param string|null $returnAnnotation
     *
     * @dataProvider dataForCreation
     */
    public function testCreation(string $comment = null, string $returnAnnotation = null)
    {
        $docBlock = new DocBlockModel($comment, $returnAnnotation);
        $this->assertEquals($comment, $docBlock->getComment());
    }
}
