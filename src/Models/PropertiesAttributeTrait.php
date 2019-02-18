<?php


namespace HKwak\PhpGen\Models;

trait PropertiesAttributeTrait
{
    /**
     * @var PropertyCollection
     */
    protected $properties;

    /**
     * @var ConstCollection
     */
    protected $consts;

    /**
     * @param PropertyModel $property
     *
     * @return static
     */
    final public function addProperty(PropertyModel $property)
    {
        if (!isset($this->properties)) {
            $this->properties = new PropertyCollection();
        }

        $this->properties->append($property);

        return $this;
    }

    /**
     * Getting the collection of all properties
     * @return PropertyCollection
     */
    public function getProperties(): PropertyCollection
    {
        return $this->properties ?? new PropertyCollection();
    }

    public function addConst(ConstModel $constModel)
    {
        if (!isset($this->consts)) {
            $this->consts = new ConstCollection();
        }

        $this->consts->append($constModel);
    }

    public function getConsts(): ConstCollection
    {
        return $this->consts ?? new ConstCollection();
    }
}
