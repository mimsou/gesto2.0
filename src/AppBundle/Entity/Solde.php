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
     * @var int|null
     *
     * @ORM\Column(name="exercice", type="integer", nullable=true)
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

    public function setCrbCode(?int $crbCode): self
    {
        $this->crbCode = $crbCode;

        return $this;
    }

    public function getExercice(): ?int
    {
        return $this->exercice;
    }

    public function setExercice(?int $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
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


}
