<?php

namespace HKwak\CodeGenerator\Models;


use Hkwak\Types\StringCollection;

class ClassModel extends AbstractExtendableModel implements PropertiesAttributeInterface
{
    use PropertiesAttributeTrait;

    /**
     * @var bool
     */
    private $abstract;

    /**
     * @var StringCollection
     */
    private $traits;

    /**
     * ClassModel constructor.
     *
     * @param string $name
     * @param bool $abstract
     */
    public function __construct(string $name, bool $abstract = false)
    {
        parent::__construct($name);
        $this->abstract = $abstract;
        $this->traits = new StringCollection();
    }

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->abstract;
    }

    /**
     * @param bool $abstract
     *
     * @return ClassModel
     */
    public function setAbstract(bool $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * @return StringCollection
     */
    public function getTraits(): StringCollection
    {
        return $this->traits;
    }

    /**
     * @param string $trait
     *
     * @return static
     */
    public function addTrait(string $trait): self
    {
        $this->traits->append($trait);

        return $this;
    }
}
