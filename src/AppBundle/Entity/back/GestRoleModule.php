<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * GestRoleModule
 *
 * @ORM\Table(name="gest_role_module")
 * @ORM\Entity
 */
class GestRoleModule
{

    /**
     * @var \GestRole
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestRole" , inversedBy="roleModuleColl"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_module_id", referencedColumnName="role_id")
     * })
     */
    private $roleModuleId;


    /**
     * @var \GestModule
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestModule" , inversedBy="moduleRole"   )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_role_id", referencedColumnName="module_id")
     * })
     */
    private $moduleRoleId;

    public function getRoleModuleId(): ?GestEntity
    {
        return $this->roleModuleId;
    }

    public function setRoleModuleId(?GestEntity $roleModuleId): self
    {
        $this->roleModuleId = $roleModuleId;

        return $this;
    }

    public function getModuleRoleId(): ?GestModule
    {
        return $this->moduleRoleId;
    }

    public function setModuleRoleId(?GestModule $moduleRoleId): self
    {
        $this->moduleRoleId = $moduleRoleId;

        return $this;
    }





}