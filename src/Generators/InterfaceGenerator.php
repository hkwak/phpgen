<?php


namespace HKwak\Generators;


use HKwak\CodeGenerator\Models\InterfaceModel;

class InterfaceGenerator extends AbstractFileGenerator
{
    /**
     * @param InterfaceModel $model
     *
     * @return string
     */
    function buildSignature($model): string
    {
        $code = '';

        $code .= 'class '.$model->getName();
        if ($model->getExtends()) {
            $code .= ' extends '.$model->getExtends();
        }
        if ($model->getImplements()->count()) {
            $code .= ' implements '.$model->getImplements()->implode(', ');
        }

        return $code;
    }
}
