<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="etat")
 * @ORM\Entity
 */
class Etat
{
    /**
     * @var int
     *
     * @ORM\Column(name="etat_code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $etatCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_libelle", type="string", length=100, nullable=true)
     */
    private $etatLibelle;


    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_type", type="string", length=100, nullable=true)
     */
    private $etatType;

    public function getEtatCode(): ?int
    {
        return $this->etatCode;
    }

    public function getEtatLibelle(): ?string
    {
        return $this->etatLibelle;
    }

    public function setEtatLibelle(?string $etatLibelle): self
    {
        $this->etatLibelle = $etatLibelle;

        return $this;
    }

    public function getEtatType(): ?string
    {
        return $this->etatType;
    }

    public function setEtatType(?string $etatType): self
    {
        $this->etatType = $etatType;

        return $this;
    }


}
