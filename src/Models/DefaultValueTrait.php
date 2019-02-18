<?php


namespace HKwak\CodeGenerator\Models;


trait DefaultValueTrait
{
    /**
     * @var string|null
     */
    private $defaultValue;

    /**
     * @return string|null
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param string $defaultValue
     *
     * @return static
     */
    final public function setDefaultValue(string $defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }
}
