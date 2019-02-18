<?php

namespace HKwak\PhpGen\Generators;


use HKwak\CodeStreams\PhpCodeStream;
use HKwak\Models\DocBlock;
use HKwak\Models\MethodModel;

class MethodGenerator extends AbstractGenerator
{
    /**
     * Generating the code
     *
     * @param MethodModel $model
     *
     * @param PhpCodeStream $stream
     *
     * @return string
     */
    public function generate(MethodModel $model, PhpCodeStream $stream): string
    {
        $stream
            ->indent(1);

        // adding a docblock only if it makes sense
        if ($model->getReturn() || $model->getParameters()->count() || $model->getThrows()->count() || $model->getDescription() || $model->getAnnotations()) {
            $stream->docBlockComment($this->buildDocBlock($model));
        }

        $stream
            ->code($this->buildMethodSignature($model))
            ->code('{')
            ->indent(2)
            ->code($model->getBody())
            ->indent(1)
            ->code('}');

        return $stream->build();
    }

    protected function buildMethodSignature(MethodModel $model): string
    {
        $code = '';
        if ($model->isFinal()) {
            $code .= 'final ';
        }
        $code .= $model->getAccessEnum()->value().' function '.$model->getName().'(';
        $parameters = [];

        foreach ($model->getParameters() as $parameter) {
            $parameters[] = (($parameter->getType() && strpos($parameter->getType(), '|') === false) ? $parameter->getType().' ' : '').'$'.$parameter->getName().($parameter->getDefaultValue() ? ' = '.$this->quoteValue($parameter->getDefaultValue(), $parameter->getType()) : '');
        }

        if ($model->getParameters()->count() > 3) {
            $code .= PHP_EOL."\t".implode(','.PHP_EOL."\t", $parameters).PHP_EOL.')';
        } else {
            $code .= implode(', ', $parameters).')';
        }

        if ($model->getReturn()) {
            $code .= ': '.$model->getReturn();
        }

        return $code;
    }

    protected function buildDocBlock(MethodModel $model): DocBlock
    {
        $docBlock = new DocBlock($model->getDescription());
        foreach ($model->getParameters() as $parameter) {
            $docBlock->addAnnotation(
                'param',
                ($parameter->getType() ?? 'mixed').
                ($parameter->getDefaultValue() === 'null' ? '|null' : '').
                ' $'.
                $parameter->getName().
                ($parameter->getDescription() ? ' '.$parameter->getDescription() : '')
            );
        }

        foreach ($model->getThrows() as $throw) {
            $docBlock->addAnnotation('throws', $throw);
        }

        foreach ($model->getAnnotations() as $annotation) {
            $docBlock->addAnnotation($annotation['annotation'], $annotation['text']);
        }

        if ($model->getReturn()) {
            $docBlock->setReturnAnnotation($model->getReturn());
        }

        return $docBlock;
    }
}
