<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestRole
 *
 * @ORM\Table(name="gest_role")
 * @ORM\Entity
 */
class GestRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role_libelle", type="string", length=45, nullable=true)
     */
    private $roleLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="role_group", type="integer", nullable=true)
     */
    private $roleGroup;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", inversedBy="role")
     * @ORM\JoinTable(name="role_has_steps",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="step_id", referencedColumnName="step_id")
     *   }
     * )
     */
    private $step;


    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule" ,inversedBy="role"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_module", referencedColumnName="module_id")
     * })
     */
    private $roleModule;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", inversedBy="role")
     * @ORM\JoinTable(name="role_has_actions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="action_id", referencedColumnName="action_id")
     *   }
     * )
     */
    private $action;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestMenu", mappedBy="role")
     */
    private $menu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestAccessPath", inversedBy="role")
     * @ORM\JoinTable(name="gest_role_access_path",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="rap_id", referencedColumnName="ap_id")
     *   }
     * )
     */
    private $rap;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestDataAccess", mappedBy="role" , cascade={"persist"})
     */


    private $rda;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestRoleData", mappedBy="role" , cascade={"persist"})
     */


    private $dra;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="gestRole")
     * @ORM\JoinTable(name="gest_role_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="gest_role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestList", inversedBy="role")
     * @ORM\JoinTable(name="role_has_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="list_id", referencedColumnName="list_id")
     *   }
     * )
     */
    private $list;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestRoleModule", mappedBy="roleModuleId")
     */
    private $roleModuleColl;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rap = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->action = new ArrayCollection();
        $this->rda = new ArrayCollection();
        $this->dra = new ArrayCollection();
        $this->roleModuleColl = new ArrayCollection();
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function getRoleLibelle(): ?string
    {
        return $this->roleLibelle;
    }

    public function setRoleLibelle(?string $roleLibelle): self
    {
        $this->roleLibelle = $roleLibelle;

        return $this;
    }

    public function getRoleGroup(): ?int
    {
        return $this->roleGroup;
    }

    public function setRoleGroup(?int $roleGroup): self
    {
        $this->roleGroup = $roleGroup;

        return $this;
    }

    /**
     * @return Collection|GestSteps[]
     */
    public function getStep(): Collection
    {
        return $this->step;
    }

    public function addStep(GestSteps $step): self
    {
        if (!$this->step->contains($step)) {
            $this->step[] = $step;
        }

        return $this;
    }

    public function removeStep(GestSteps $step): self
    {
        if ($this->step->contains($step)) {
            $this->step->removeElement($step);
        }

        return $this;
    }

    /**
     * @return Collection|GestMenu[]
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(GestMenu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
            $menu->addRole($this);
        }

        return $this;
    }

    public function removeMenu(GestMenu $menu): self
    {
        if ($this->menu->contains($menu)) {
            $this->menu->removeElement($menu);
            $menu->removeRole($this);
        }

        return $this;
    }

    /**
     * @return Collection|GestAccessPath[]
     */
    public function getRap(): Collection
    {
        return $this->rap;
    }

    public function addRap(GestAccessPath $rap): self
    {
        if (!$this->rap->contains($rap)) {
            $this->rap[] = $rap;
        }

        return $this;
    }

    public function removeRap(GestAccessPath $rap): self
    {
        if ($this->rap->contains($rap)) {
            $this->rap->removeElement($rap);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    /**
     * @return Collection|GestList[]
     */
    public function getList(): Collection
    {
        return $this->list;
    }

    public function addList(GestList $list): self
    {
        if (!$this->list->contains($list)) {
            $this->list[] = $list;
        }

        return $this;
    }

    public function removeList(GestList $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
        }

        return $this;
    }

    /**
     * @return Collection|GestActions[]
     */
    public function getAction(): Collection
    {
        return $this->action;
    }

    public function addAction(GestActions $action): self
    {
        if (!$this->action->contains($action)) {
            $this->action[] = $action;
        }

        return $this;
    }

    public function removeAction(GestActions $action): self
    {
        if ($this->action->contains($action)) {
            $this->action->removeElement($action);
        }

        return $this;
    }

    /**
     * @return Collection|GestDataAccess[]
     */
    public function getRda(): Collection
    {
        return $this->rda;
    }

    public function addRda(GestDataAccess $rda): self
    {
        if (!$this->rda->contains($rda)) {
            $this->rda[] = $rda;
            $rda->setRole($this);
        }

        return $this;
    }

    public function removeRda(GestDataAccess $rda): self
    {
        if ($this->rda->contains($rda)) {
            $this->rda->removeElement($rda);
            // set the owning side to null (unless already changed)
            if ($rda->getRole() === $this) {
                $rda->setRole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestroleData[]
     */
    public function getDra(): Collection
    {
        return $this->dra;
    }

    public function addDra(GestroleData $dra): self
    {
        if (!$this->dra->contains($dra)) {
            $this->dra[] = $dra;
            $dra->setRole($this);
        }

        return $this;
    }

    public function removeDra(GestroleData $dra): self
    {
        if ($this->dra->contains($dra)) {
            $this->dra->removeElement($dra);
            // set the owning side to null (unless already changed)
            if ($dra->getRole() === $this) {
                $dra->setRole(null);
            }
        }

        return $this;
    }

    public function getRoleModule(): ?GestModule
    {
        return $this->roleModule;
    }

    public function setRoleModule(?GestModule $roleModule): self
    {
        $this->roleModule = $roleModule;

        return $this;
    }

    /**
     * @return Collection|GestRoleModule[]
     */
    public function getRoleModuleColl(): Collection
    {
        return $this->roleModuleColl;
    }

    public function addRoleModuleColl(GestRoleModule $roleModuleColl): self
    {
        if (!$this->roleModuleColl->contains($roleModuleColl)) {
            $this->roleModuleColl[] = $roleModuleColl;
            $roleModuleColl->setRoleModuleId($this);
        }

        return $this;
    }

    public function removeRoleModuleColl(GestRoleModule $roleModuleColl): self
    {
        if ($this->roleModuleColl->contains($roleModuleColl)) {
            $this->roleModuleColl->removeElement($roleModuleColl);
            // set the owning side to null (unless already changed)
            if ($roleModuleColl->getRoleModuleId() === $this) {
                $roleModuleColl->setRoleModuleId(null);
            }
        }

        return $this;
    }


   
}
