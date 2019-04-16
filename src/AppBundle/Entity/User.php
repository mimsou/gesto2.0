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
    private $role;

    public function __construct()
    {
        parent::__construct();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
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
        return $this->role;
    }

    public function addRols(GestRole $role): self
    { 
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->addRap($this);
        }

        return $this;
    }

    public function removeRols(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removeRap($this);
        }

        return $this;
    }



}
