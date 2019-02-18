<?php


namespace HKwak\PhpGen\Generators;


use HKwak\PhpGen\Models\ClassModel;
use HKwak\PhpGen\Models\ConstModel;

class ClassGenerator extends AbstractFileGenerator
{
    use PropertiesBuildingTrait;

    /**
     * @var PropertyGenerator
     */
    protected $propertyGenerator;

    /**
     * ClassGenerator constructor.
     *
     * @param MethodGenerator $methodGenerator
     * @param PropertyGenerator $propertyGenerator
     * @param NamespaceManager $namespaceManager
     */
    public function __construct(MethodGenerator $methodGenerator, PropertyGenerator $propertyGenerator, NamespaceManager $namespaceManager)
    {
        parent::__construct($methodGenerator, $namespaceManager);
        $this->propertyGenerator = $propertyGenerator;
    }

    /**
     * @param ClassModel $model
     *
     * @return string
     */
    function buildSignature($model): string
    {
        $code = '';
        if ($model->isAbstract()) {
            $code .= 'abstract ';
        }
        $code .= 'class '.$model->getName();
        if ($model->getExtends()) {
            $code .= ' extends '.$model->getExtends();
        }
        if ($model->getImplements()->count()) {
            $code .= ' implements '.$model->getImplements()->implode(', ');
        }

        return $code;
    }

    /**
     * @param ClassModel $model
     */
    public function buildBody($model)
    {
        if ($model->getConsts()->count()) {
            /** @var ConstModel $const */
            foreach ($model->getConsts() as $const) {
                $code = 'const '.$const->getName().' = '.$const->getValue().';';
                $this->stream->code($code);
            }
        }
        if ($model->getTraits()->count()) {
            $code = 'use '.$model->getTraits()->implode(',').';';
            $this->stream->code($code);

            if ($model->getProperties()->count()) {
                $this->stream->eol(); // adding a gap between traits and properties
            }
        }
        $this->buildProperties($model, $this->propertyGenerator);

        if ($model->getProperties()->count()) {
            $this->stream->eol(); // adding a gap between properties and methods
        }

        parent::buildBody($model);
    }
}
