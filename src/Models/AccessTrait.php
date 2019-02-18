<?php


namespace HKwak\CodeGenerator\Models;


trait AccessTrait
{
    /**
     * @var AccessEnum
     */
    private $access;

    /**
     * @return AccessEnum
     */
    public function getAccessEnum(): AccessEnum
    {
        return $this->access;
    }

    /**
     * @param AccessEnum $access
     *
     * @return self
     */
    public function setAccessEnum(AccessEnum $access): self
    {
        $this->access = $access;

        return $this;
    }
}
