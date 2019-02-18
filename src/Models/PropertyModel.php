<?php


namespace HKwak\PhpGen\Models;


class PropertyModel extends AbstractModel
{
    use AccessTrait, DefaultValueTrait, AnnotationsTrait;

    /**
     * @var string
     */
    private $type;

    /**
     * @var bool
     */
    private $nullable = false;

    /**
     * PropertyModel constructor.
     *
     * @param string $name
     * @param string $type
     * @param AccessEnum|null $access
     * @param string $defaultValue
     */
    public function __construct(string $name, string $type, AccessEnum $access = null, string $defaultValue = null)
    {
        parent::__construct($name);
        $this->access = $access ?? AccessEnum::PRIVATE();
        $this->defaultValue = $defaultValue ?? null;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return PropertyModel
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable)
    {
        $this->nullable = $nullable;
    }
}