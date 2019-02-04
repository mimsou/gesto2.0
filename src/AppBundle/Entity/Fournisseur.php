<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur", indexes={@ORM\Index(name="fk_fournisseur_step1_idx", columns={"fournisseur_etat"})})
 * @ORM\Entity
 */
class Fournisseur
{
    /**
     * @var string
     *
     * @ORM\Column(name="fournisseur_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fournisseurCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fournisseur_libelle", type="string", length=100, nullable=true)
     */
    private $fournisseurLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fournisseur_etat", type="integer", nullable=true)
     */
    private $fournisseurEtat;

    public function getFournisseurCode(): ?string
    {
        return $this->fournisseurCode;
    }

    public function setFournisseurCode(?string $fournisseurCode): self
    {
        $this->fournisseurCode = $fournisseurCode;

        return $this;
    }

    public function getFournisseurLibelle(): ?string
    {
        return $this->fournisseurLibelle;
    }

    public function setFournisseurLibelle(?string $fournisseurLibelle): self
    {
        $this->fournisseurLibelle = $fournisseurLibelle;

        return $this;
    }

    public function getFournisseurEtat(): ?int
    {
        return $this->fournisseurEtat;
    }

    public function setFournisseurEtat(?int $fournisseurEtat): self
    {
        $this->fournisseurEtat = $fournisseurEtat;

        return $this;
    }


}
