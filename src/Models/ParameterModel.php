<?php


namespace HKwak\CodeGenerator\Models;


class ParameterModel extends AbstractModel
{
    use DefaultValueTrait;

    /**
     * @var string|null
     */
    private $type;

    /**
     * ParameterModel constructor.
     *
     * @param string $name
     * @param string|null $type
     * @param string|null $defaultValue
     */
    public function __construct(string $name, string $type = null, string $defaultValue = null)
    {
        parent::__construct($name);
        $this->type = $type;
        $this->defaultValue = $defaultValue ?? '';
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return ParameterModel
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
