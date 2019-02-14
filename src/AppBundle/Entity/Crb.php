<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Crb
 *
 * @ORM\Table(name="crb")
 * @ORM\Entity
 */
class Crb
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="crb_libelle", type="string", length=100, nullable=true)
     */
    private $crbLibelle;


    /**
     * @var string
     *
     * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $crbCode;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Solde", mappedBy="soldeCrb" , cascade={"persist"})
     */

    private  $soldes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->soldes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCrbLibelle(): ?string
    {
        return $this->crbLibelle;
    }

    public function setCrbLibelle(?string $crbLibelle): self
    {
        $this->crbLibelle = $crbLibelle;

        return $this;
    }

    public function getCrbCode(): ?string
    {
        return $this->crbCode;
    }

    /**
     * @return Collection|Solde[]
     */
    public function getSoldes(): Collection
    {
        return $this->soldes;
    }

    public function addSolde(Solde $solde): self
    {
        if (!$this->soldes->contains($solde)) {
            $this->soldes[] = $solde;
            $solde->setSoldeCrb($this);
        }

        return $this;
    }

    public function removeSolde(Solde $solde): self
    {
        if ($this->soldes->contains($solde)) {
            $this->soldes->removeElement($solde);
            // set the owning side to null (unless already changed)
            if ($solde->getSoldeCrb() === $this) {
                $solde->setSoldeCrb(null);
            }
        }

        return $this;
    }





}
