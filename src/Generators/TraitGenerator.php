<?php

namespace HKwak\PhpGen\Generators;


use HKwak\Models\TraitModel;

class TraitGenerator extends AbstractFileGenerator
{
    use PropertiesBuildingTrait;

    /**
     * @var PropertyGenerator
     */
    protected $propertyGenerator;

    /**
     * TraitGenerator constructor.
     *
     * @param MethodGenerator $methodGenerator
     * @param NamespaceManager $namespaceManager
     * @param PropertyGenerator $propertyGenerator
     */
    public function __construct(MethodGenerator $methodGenerator, NamespaceManager $namespaceManager, PropertyGenerator $propertyGenerator)
    {
        parent::__construct($methodGenerator, $namespaceManager);
        $this->propertyGenerator = $propertyGenerator;
    }

    /**
     * @param TraitModel $model
     *
     * @return string
     */
    function buildSignature($model): string
    {
        $code = 'trait '.$model->getName();

        return $code;
    }

    /**
     * @param TraitModel $model
     */
    public function buildBody($model)
    {
        $this->buildProperties($model, $this->propertyGenerator);
        parent::buildBody($model);
    }
}
