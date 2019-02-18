<?php


namespace HKwak\PhpGen\Models;


trait AnnotationsTrait
{
    /**
     * @var array
     */
    private $annotations = [];

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * Add additional annotations to the method. It is not necessary to add annotation for return, parameters and thrown exceptions as these will be generated automatically
     *
     * @param string $annotation
     * @param string|null $text
     *
     * @return static
     */
    final public function addAnnotation(string $annotation, string $text = null)
    {
        $this->annotations[] = ['annotation' => $annotation, 'text' => $text];

        return $this;
    }
}
