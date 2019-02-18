<?php


namespace HKwak\CodeGenerator\Models;


use Hkwak\Types\StringCollection;
use InvalidArgumentException;

class MethodModel extends AbstractModel
{
    use AccessTrait, AnnotationsTrait;

    /**
     * @var string
     */
    private $body = '';

    /**
     * @var string
     */
    private $return = '';

    /**
     * @var AccessEnum
     */
    private $access;

    /**
     * @var ParameterCollection
     */
    private $parameters;

    /**
     * @var StringCollection
     */
    private $throws;

    /**
     * @var bool
     */
    private $final = false;

    /**
     * MethodModel constructor.
     * If Method has no body - it is only a declaration. Abstract and interface methods will have no body
     *
     * @param string $name
     * @param string|null $return
     * @param AccessEnum|null $access
     */
    public function __construct(string $name, string $return = null, AccessEnum $access = null)
    {
        parent::__construct($name);
        $this->body = '';
        $this->return = $return ?? '';
        $this->access = $access ?? AccessEnum::PUBLIC();
        $this->parameters = new ParameterCollection();
        $this->throws = new StringCollection();
    }

    /**
     * @param ParameterModel $parameter
     *
     * @return MethodModel
     */
    final public function addParameter(ParameterModel $parameter): self
    {
        if ($this->getParameterByName($parameter->getName())) {
            {
                throw new InvalidArgumentException('$parameter with the same name '.$parameter->getName().' already exists in the method');
            }
        }
        $this->parameters->append($parameter);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return ParameterModel|null
     */
    public function getParameterByName(string $name)
    {
        return $this->parameters->find(
            function (ParameterModel $parameter) use ($name) {
                return $name === $parameter->getName();
            }
        );
    }

    /**
     * @return ParameterCollection|ParameterModel[]
     */
    public function getParameters(): ParameterCollection
    {
        return $this->parameters;
    }

    /**
     * @param StringCollection $throws
     *
     * @return static
     */
    final public function setThrows(StringCollection $throws): self
    {
        $this->throws = $throws;

        return $this;
    }

    /**
     * @param string $throws
     *
     * @return static
     */
    final public function addThrows(string $throws): self
    {
        $this->throws->append($throws);

        return $this;
    }

    /**
     * @return StringCollection
     */
    public function getThrows(): StringCollection
    {
        return $this->throws;
    }

    /**
     * @return AccessEnum
     */
    public function getAccess(): AccessEnum
    {
        return $this->access;
    }

    /**
     * @param AccessEnum $access
     *
     * @return static
     */
    final public function setAccess(AccessEnum $access): self
    {
        $this->access = $access;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     *
     * @return static
     */
    final public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getReturn(): string
    {
        return $this->return;
    }

    /**
     * @param string $return
     *
     * @return static
     */
    final  public function setReturn(string $return): self
    {
        $this->return = $return;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->final;
    }

    /**
     * @param bool $final
     *
     * @return static
     */
    final public function setFinal(bool $final): self
    {
        $this->final = $final;

        return $this;
    }

    /**
     * @param ParameterCollection $parameters
     *
     * @return static
     */
    public function setParameters(ParameterCollection $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }
}
