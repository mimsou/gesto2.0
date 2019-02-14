<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Renouvellement
 *
 * @ORM\Table(name="renouvellement", indexes={@ORM\Index(name="fk_renouvellement_step1_idx", columns={"renouvellement_etat"})})
 * @ORM\Entity
 */
class Renouvellement
{
    /**
     * @var string
     *
     * @ORM\Column(name="renouvellement_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $renouvellementCode;

    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="renouvellement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="renouvellement_exercice", referencedColumnName="exercice_code")
     * })
     */

    private $renouvellementExercice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="renouvellement_etat", type="integer", nullable=true)
     */
    private $renouvellementEtat;

    public function getRenouvellementCode(): ?string
    {
        return $this->renouvellementCode;
    }



    public function getRenouvellementEtat(): ?int
    {
        return $this->renouvellementEtat;
    }

    public function setRenouvellementEtat(?int $renouvellementEtat): self
    {
        $this->renouvellementEtat = $renouvellementEtat;

        return $this;
    }

    public function getRenouvellementExercice(): ?Exercice
    {
        return $this->renouvellementExercice;
    }

    public function setRenouvellementExercice(?Exercice $renouvellementExercice): self
    {
        $this->renouvellementExercice = $renouvellementExercice;

        return $this;
    }


}
