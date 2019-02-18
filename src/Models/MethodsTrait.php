<?php


namespace HKwak\PhpGen\Models;


trait MethodsTrait
{
    /**
     * @var MethodCollection
     */
    private $methods;

    /**
     * @param MethodModel $method
     *
     * @return static
     */
    final public function addMethod(MethodModel $method)
    {
        $this->methods->append($method);

        return $this;
    }

    /**
     * @return MethodCollection
     */
    final public function getMethods(): MethodCollection
    {
        return $this->methods;
    }
}
