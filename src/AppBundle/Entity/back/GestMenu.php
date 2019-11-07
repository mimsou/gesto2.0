<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestMenu
 *
 * @ORM\Table(name="gest_menu")
 * @ORM\Entity
 */
class GestMenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="menu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $menuId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu_libelle", type="string", length=100, nullable=true)
     */
    private $menuLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu_tag", type="string", length=100, nullable=true)
     */
    private $menuTag;

    /**
     *tring|null
     *
     * @ORM\Column(name="menu_interface", type="string", length=100, nullable=true)
     */
    private $menuInterface;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestMenu",inversedBy="link")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_parent", referencedColumnName="menu_id"  )
     * })
     */
    private $menuParent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", inversedBy="menu")
     * @ORM\JoinTable(name="gest_menu_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="menu_id", referencedColumnName="menu_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   }
     * )
     */
    private $role;

   /**
     * @var string|null
     *
     * @ORM\Column(name="menu_process", type="integer",   nullable=true)
     */
    private $menuProcess;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestMenu", mappedBy="menuParent" , cascade={"persist"})
     */

    private $link;



    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule" ,inversedBy="menu"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_module", referencedColumnName="module_id")
     * })
     */
    private $menuModule;





    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->link = new ArrayCollection();
    }

    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

    public function getMenuLibelle(): ?string
    {
        return $this->menuLibelle;
    }

    public function setMenuLibelle(?string $menuLibelle): self
    {
        $this->menuLibelle = $menuLibelle;

        return $this;
    }

    public function getMenuTag(): ?string
    {
        return $this->menuTag;
    }

    public function setMenuTag(?string $menuTag): self
    {
        $this->menuTag = $menuTag;

        return $this;
    }

    public function getMenuInterface(): ?string
    {
        return $this->menuInterface;
    }

    public function setMenuInterface(?string $menuInterface): self
    {
        $this->menuInterface = $menuInterface;

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
        }

        return $this;
    }

    public function removeRole(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
        }

        return $this;
    }

    public function getMenuProcess(): ?int
    {
        return $this->menuProcess;
    }

    public function setMenuProcess(?int $menuProcess): self
    {
        $this->menuProcess = $menuProcess;

        return $this;
    }



    /**
     * @return Collection|GestMenu[]
     */
    public function getLink(): Collection
    {
        return $this->link;
    }

    public function addLink(GestMenu $link): self
    {
        if (!$this->link->contains($link)) {
            $this->link[] = $link;
            $link->setMenuParent($this);
        }

        return $this;
    }

    public function removeLink(GestMenu $link): self
    {
        if ($this->link->contains($link)) {
            $this->link->removeElement($link);
            // set the owning side to null (unless already changed)
            if ($link->getMenuParent() === $this) {
                $link->setMenuParent(null);
            }
        }

        return $this;
    }

    public function getMenuParent(): ?self
    {
        return $this->menuParent;
    }

    public function setMenuParent(?self $menuParent): self
    {
        $this->menuParent = $menuParent;

        return $this;
    }

    public function getMenuModule(): ?GestModule
    {
        return $this->menuModule;
    }

    public function setMenuModule(?GestModule $menuModule): self
    {
        $this->menuModule = $menuModule;

        return $this;
    }

    

}
