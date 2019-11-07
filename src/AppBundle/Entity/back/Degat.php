<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Degat
 *
 * @ORM\Table(name="degat")
 * @ORM\Entity
 */
class Degat
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_degat", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeDegat;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=10, nullable=true)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=true)
     */
    private $etat;

    public function getCodeDegat(): ?string
    {
        return $this->codeDegat;
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
