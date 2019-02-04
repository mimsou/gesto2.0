<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestAccessPath
 *
 * @ORM\Table(name="gest_access_path")
 * @ORM\Entity
 */
class GestAccessPath
{
    /**
     * @var int
     *
     * @ORM\Column(name="ap_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $apId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ap_controller", type="string", length=200, nullable=true)
     */
    private $apController;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ap_libelle", type="string", length=200, nullable=true)
     */
    private $apLibelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="rap")
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getApId(): ?int
    {
        return $this->apId;
    }

    public function getApController(): ?string
    {
        return $this->apController;
    }

    public function setApController(?string $apController): self
    {
        $this->apController = $apController;

        return $this;
    }

    public function getApLibelle(): ?string
    {
        return $this->apLibelle;
    }

    public function setApLibelle(?string $apLibelle): self
    {
        $this->apLibelle = $apLibelle;

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
            $role->addRap($this);
        }

        return $this;
    }

    public function removeRole(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removeRap($this);
        }

        return $this;
    }

}
