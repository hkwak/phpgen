<?php


namespace HKwak\Generators;


class NamespaceManager
{
    /**
     * Getting the class name from fully qualified class name
     *
     * @param string $fullyQualifiedClassName
     *
     * @return string
     */
    public function getClassName(string $fullyQualifiedClassName): string
    {
        return substr($fullyQualifiedClassName, strrpos($fullyQualifiedClassName, '\\') + 1);
    }

    /**
     * @param string $fullyQualifiedClassName
     *
     * @return string
     */
    public function getNamespace(string $fullyQualifiedClassName): string
    {
        return substr($fullyQualifiedClassName, 0, strrpos($fullyQualifiedClassName, '\\'));
    }
}
