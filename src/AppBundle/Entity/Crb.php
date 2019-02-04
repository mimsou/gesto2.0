<?php

namespace AppBundle\Entity;

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
     * @var \Solde
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Solde")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="crb_code", referencedColumnName="crb_code")
     * })
     */
    private $crbCode;

    public function getCrbLibelle(): ?string
    {
        return $this->crbLibelle;
    }

    public function setCrbLibelle(?string $crbLibelle): self
    {
        $this->crbLibelle = $crbLibelle;

        return $this;
    }

    public function getCrbCode(): ?Solde
    {
        return $this->crbCode;
    }

    public function setCrbCode(?Solde $crbCode): self
    {
        $this->crbCode = $crbCode;

        return $this;
    }


}
