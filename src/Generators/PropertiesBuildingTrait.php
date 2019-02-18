<?php


namespace HKwak\Generators;


use HKwak\CodeGenerator\CodeStreams\PhpCodeStream;
use HKwak\CodeGenerator\Models\PropertiesAttributeInterface;

trait PropertiesBuildingTrait
{
    public function buildProperties(PropertiesAttributeInterface $model, PropertyGenerator $propertyGenerator): string
    {
        $code = [];
        /**
         * @var PhpCodeStream $stream
         */
        $stream = $this->stream;
        foreach ($model->getProperties() as $key => $property) {
            if ($key > 0) {

                $stream->eol();
            }
            $code[] = $propertyGenerator->generate($property, $this->stream);
        }

        return implode(PHP_EOL, $code);
    }
}
