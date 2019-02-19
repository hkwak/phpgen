<?php

namespace HKwak\PhpGen\Models;


use InvalidArgumentException;

class DocBlockModel
{
    /**
     * @var string|null
     */
    private $comment;

    /**
     * @var array
     */
    private $annotations = [];

    /**
     * @var null|string
     */
    private $returnAnnotation;

    /**
     * DocBlock constructor.
     *
     * @param string|null $comment
     * @param string|null $returnAnnotation
     */
    public function __construct(string $comment = null, string $returnAnnotation = null)
    {
        $this->comment = $comment;
        $this->returnAnnotation = $returnAnnotation;
    }

    /**
     * @param string $comment
     *
     * @return DocBlockModel
     */
    public function setComment(string $comment): DocBlockModel
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return array
     */
    public function getAnnotations(): array
    {
        return $this->annotations;
    }

    /**
     * @param string $annotationType
     * @param string|null $text
     */
    public function addAnnotation(string $annotationType, string $text = null)
    {
        if (empty(trim($annotationType))) {
            throw new InvalidArgumentException('Annotation Type cannot be empty');
        }
        if ($text != null && empty(trim($text))) {
            throw new InvalidArgumentException('Text cannot be empty');
        }
        $this->annotations[] = ['annotation' => $annotationType, 'text' => $text];
    }

    /**
     * @return null|string
     */
    public function getReturnAnnotation()
    {
        return $this->returnAnnotation;
    }

    /**
     * @param string $returnAnnotation
     */
    public function setReturnAnnotation(string $returnAnnotation)
    {
        $this->returnAnnotation = $returnAnnotation;
    }

    public function getAnnotationsByType(string $annotationType): array
    {
        return array_filter(
            $this->annotations,
            function ($element) use ($annotationType) {
                return $element['annotation'] === $annotationType;
            }
        );
    }

    public function getParameterAnnotations(): array
    {
        return $this->getAnnotationsByType('param');
    }

    public function getThrowsAnnotations(): array
    {
        return $this->getAnnotationsByType('throws');
    }

    public function getRemainingAnnotations(): array
    {
        $excludedAnnotationTypes = ['param', 'throws'];

        return array_filter(
            $this->annotations,
            function ($element) use ($excludedAnnotationTypes) {
                return !in_array($element['annotation'], $excludedAnnotationTypes);
            }
        );
    }

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }
}
