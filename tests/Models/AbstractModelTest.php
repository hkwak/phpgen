<?php

namespace HKwak\PhpGenTests\Models;


use HKwak\PhpGenTests\Models\Fixtures\ConcreteModel;
use PHPUnit\Framework\TestCase;

class AbstractModelTest extends TestCase
{
    public function testName()
    {
        $name = 'testName';
        $model = new ConcreteModel($name);
        $this->assertEquals($name, $model->getName());

        $name2 = 'testName2';
        $model->setName($name2);
        $this->assertEquals($name2, $model->getName());
    }

    public function testDescription()
    {
        $desc = 'testDesc';
        $model = new ConcreteModel('name');
        $model->setDescription($desc);
        $this->assertEquals($desc, $model->getDescription());
    }
}
