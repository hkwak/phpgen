<?php


namespace HKwak\CodeGenerator\Models;


use Hkwak\Types\StringCollection;

class AbstractExtendableModel extends AbstractFileModel
{
    /**
     * @var string|null
     */
    private $extends;

    /**
     * @var StringCollection
     */
    private $implements;

    /**
     * AbstractExtendableEntity constructor.
     *
     * @param string $name
     * @param string $extends
     * @param StringCollection $implements
     */
    public function __construct(string $name, string $extends = null, StringCollection $implements = null)
    {
        parent::__construct($name);
        $this->extends = $extends;
        $this->implements = $implements ?? new StringCollection();
    }

    /**
     * @return string|null
     */
    public function getExtends()
    {
        return $this->extends;
    }

    /**
     * @param string $extends
     *
     * @return static
     */
    final public function setExtends(string $extends): self
    {
        $this->extends = $extends;

        return $this;
    }

    /**
     * @return StringCollection
     */
    public function getImplements()
    {
        return $this->implements;
    }

    /**
     * @param string $implements
     *
     * @return static
     */
    public function addImplements(string $implements): self
    {
        $this->implements->append($implements);

        return $this;
    }
}
