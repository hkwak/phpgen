<?php


namespace HKwak\PhpGen\Models;


use Hkwak\Types\StringCollection;

/**
 * Class AbstractFileModel
 *
 * Represents the PHP File entity which can be a class, interface or a trait
 */
class AbstractFileModel extends AbstractModel
{
    use MethodsTrait, AnnotationsTrait;

    /**
     * @var StringCollection;
     */
    private $uses;

    /**
     * @var string|null
     */
    private $namespace;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->uses = new StringCollection();
        $this->methods = new MethodCollection();
    }

    /**
     * @return null|string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return static
     */
    final public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @param string $use
     *
     * @return static
     */
    public function addUse(string $use): self
    {
        $this->uses->append($use);

        return $this;
    }

    /**
     * @return StringCollection
     */
    public function getUses(): StringCollection
    {
        return $this->uses;
    }
}
