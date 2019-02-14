<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solde
 *
 * @ORM\Table(name="solde")
 * @ORM\Entity
 */
class Solde
{
    /**
     * @var string
     *
     * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $crbCode;


    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="Crb" , inversedBy="soldes"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solde_crb", referencedColumnName="crb_code")
     * })
     */
    private $soldeCrb;



    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="solde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exercice", referencedColumnName="exercice_code")
     * })
     */

    private $exercice;

    /**
     * @var float|null
     *
     * @ORM\Column(name="solde", type="float", precision=10, scale=0, nullable=true)
     */
    private $solde;

    public function getCrbCode(): ?string
    {
        return $this->crbCode;
    }



    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getSoldeCrb(): ?Crb
    {
        return $this->soldeCrb;
    }

    public function setSoldeCrb(?Crb $soldeCrb): self
    {
        $this->soldeCrb = $soldeCrb;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }



}
