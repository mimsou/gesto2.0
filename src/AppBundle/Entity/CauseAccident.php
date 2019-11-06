<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CauseAccident
 *
 * @ORM\Table(name="cause_accident")
 * @ORM\Entity
 */
class CauseAccident
{
    /**
     * @var int
     *
     * @ORM\Column(name="code_cause_acc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeCauseAcc;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=200, nullable=true)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    public function getCodeCauseAcc(): ?int
    {
        return $this->codeCauseAcc;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
