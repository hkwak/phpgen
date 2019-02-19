<?php

namespace HKwak\PhpGen\Generators;

use HKwak\PhpGen\CodeStreams\PhpCodeStream;
use HKwak\PhpGen\Models\DocBlockModel;
use HKwak\PhpGen\Models\PropertyModel;

class PropertyGenerator extends AbstractGenerator
{
    /**
     * Generating the code
     *
     * @param PropertyModel $model
     *
     * @param PhpCodeStream $stream
     *
     * @return string
     */
    public function generate(PropertyModel $model, PhpCodeStream $stream): string
    {
        $stream
            ->indent(1)
            ->docBlockComment($this->buildDocBlock($model))
            ->code($model->getAccessEnum()->value().' $'.$model->getName().';');

        return $stream->build();
    }

    protected function buildDocBlock(PropertyModel $model): DocBlockModel
    {
        $docBlock = new DocBlockModel($model->getDescription());
        $docBlock->addAnnotation('var', ($model->getType() ?? 'mixed').(($model->isNullable() || $model->getDefaultValue() === 'null') ? '|null' : ''));

        foreach ($model->getAnnotations() as $annotation) {
            $docBlock->addAnnotation($annotation['annotation'], $annotation['text']);
        }

        return $docBlock;
    }
}
