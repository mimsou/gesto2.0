<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestModule
 *
 * @ORM\Table(name="gest_module")
 * @ORM\Entity
 */
class GestModule
{
    /**
     * @var int
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $moduleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="module_libelle", type="string", length=100, nullable=true)
     */
    private $moduleLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="module_database_suffix", type="string", length=100, nullable=true)
     */
    private $moduleDatabaseSuffix;


    /**
     * @var string|null
     *
     * @ORM\Column(name="module_icone", type="string", length=100, nullable=true)
     */
    private $moduleIcone;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestRole", mappedBy="roleModule")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestMenu", mappedBy="menuModule")
     */
    private $menu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestProcess", mappedBy="processModule")
     */

    private $process;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestEntity", mappedBy="entityModule")
     */

    private $entity;



    public function __construct()
    {
        $this->role = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->process = new ArrayCollection();
        $this->entity = new ArrayCollection();
    }

    public function getModuleId(): ?int
    {
        return $this->moduleId;
    }

    public function setModuleId(?int $moduleId): self
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    public function getModuleLibelle(): ?string
    {
        return $this->moduleLibelle;
    }

    public function setModuleLibelle(?string $moduleLibelle): self
    {
        $this->moduleLibelle = $moduleLibelle;

        return $this;
    }

    public function getModuleDatabaseSuffix(): ?string
    {
        return $this->moduleDatabaseSuffix;
    }

    public function setModuleDatabaseSuffix(?string $moduleDatabaseSuffix): self
    {
        $this->moduleDatabaseSuffix = $moduleDatabaseSuffix;

        return $this;
    }

    public function getModuleIcone(): ?string
    {
        return $this->moduleIcone;
    }

    public function setModuleIcone(?string $moduleIcone): self
    {
        $this->moduleIcone = $moduleIcone;

        return $this;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(GestRole $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->setRoleModule($this);
        }

        return $this;
    }

    public function removeRole(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            // set the owning side to null (unless already changed)
            if ($role->getRoleModule() === $this) {
                $role->setRoleModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(GestRole $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
            $menu->setMenuModule($this);
        }

        return $this;
    }

    public function removeMenu(GestRole $menu): self
    {
        if ($this->menu->contains($menu)) {
            $this->menu->removeElement($menu);
            // set the owning side to null (unless already changed)
            if ($menu->getMenuModule() === $this) {
                $menu->setMenuModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getProcess(): Collection
    {
        return $this->process;
    }

    public function addProcess(GestRole $process): self
    {
        if (!$this->process->contains($process)) {
            $this->process[] = $process;
            $process->setProcessModule($this);
        }

        return $this;
    }

    public function removeProcess(GestRole $process): self
    {
        if ($this->process->contains($process)) {
            $this->process->removeElement($process);
            // set the owning side to null (unless already changed)
            if ($process->getProcessModule() === $this) {
                $process->setProcessModule(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getEntity(): Collection
    {
        return $this->entity;
    }

    public function addEntity(GestRole $entity): self
    {
        if (!$this->entity->contains($entity)) {
            $this->entity[] = $entity;
            $entity->setEntityModule($this);
        }

        return $this;
    }

    public function removeEntity(GestRole $entity): self
    {
        if ($this->entity->contains($entity)) {
            $this->entity->removeElement($entity);
            // set the owning side to null (unless already changed)
            if ($entity->getEntityModule() === $this) {
                $entity->setEntityModule(null);
            }
        }

        return $this;
    }

}