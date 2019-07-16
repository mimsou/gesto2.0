<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id; // PENSER A METTRE EN PROTECTED ET NON PRIVATE

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="user")
     */
    private $rols;

    public function __construct()
    {
        parent::__construct();
        $this->rols = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getRols(): Collection
    {
        return $this->rols;
    }

    public function addRols(GestRole $rols): self
    { 
        if (!$this->rols->contains($rols)) {
            $this->rols[] = $rols;
            $rols->addRap($this);
        }

        return $this;
    }

    public function removeRols(GestRole $rols): self
    {
        if ($this->rols->contains($rols)) {
            $this->rols->removeElement($rols);
            $rols->removeRap($this);
        }

        return $this;
    }

    public function addRol(GestRole $rol): self
    {
        if (!$this->rols->contains($rol)) {
            $this->rols[] = $rol;
            $rol->addUser($this);
        }

        return $this;
    }

    public function removeRol(GestRole $rol): self
    {
        if ($this->rols->contains($rol)) {
            $this->rols->removeElement($rol);
            $rol->removeUser($this);
        }

        return $this;
    }



    
    

}
