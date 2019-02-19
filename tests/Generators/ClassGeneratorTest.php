<?php


namespace HKwak\PhpGenTests\Generators;


use HKwak\PhpGen\Generators\ClassGenerator;
use HKwak\PhpGen\Generators\MethodGenerator;
use HKwak\PhpGen\Generators\NamespaceManager;
use HKwak\PhpGen\Generators\PropertyGenerator;
use PHPUnit\Framework\TestCase;

class ClassGeneratorTest extends TestCase
{
    public function testClassGenerator() {
        $classGenerator = new ClassGenerator(
            new MethodGenerator(),
            new PropertyGenerator(),
            new NamespaceManager()
        );

        $classGenerator->generate($classModel);
    }
}
