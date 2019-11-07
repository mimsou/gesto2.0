<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * GestModuleEntity
 *
 * @ORM\Table(name="gest_module_entity")
 * @ORM\Entity
 */
class GestModuleEntity
{

    /**
     * @var \GestEntity
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestEntity" , inversedBy="entityModule"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_module_id", referencedColumnName="entity_id")
     * })
     */
    private $entityModuleId;


    /**
     * @var \GestModule
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestModule" , inversedBy="moduleEntity"   )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_entity_id", referencedColumnName="module_id")
     * })
     */
    private $moduleEntityId;

    public function getEntityModuleId(): ?GestEntity
    {
        return $this->entityModuleId;
    }

    public function setEntityModuleId(?GestEntity $entityModuleId): self
    {
        $this->entityModuleId = $entityModuleId;

        return $this;
    }

    public function getModuleEntityId(): ?GestModule
    {
        return $this->moduleEntityId;
    }

    public function setModuleEntityId(?GestModule $moduleEntityId): self
    {
        $this->moduleEntityId = $moduleEntityId;

        return $this;
    }





}