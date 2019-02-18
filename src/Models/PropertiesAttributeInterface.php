<?php


namespace HKwak\PhpGen\Models;


interface PropertiesAttributeInterface
{
    /**
     * @param PropertyModel $property
     */
    public function addProperty(PropertyModel $property);

    /**
     * Getting the collection of all properties
     * @return PropertyCollection
     */
    public function getProperties(): PropertyCollection;

    public function addConst(ConstModel $constModel);

    public function getConsts(): ConstCollection;

}
