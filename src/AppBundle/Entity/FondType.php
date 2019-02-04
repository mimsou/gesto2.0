<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FondType
 *
 * @ORM\Table(name="fond_type")
 * @ORM\Entity
 */
class FondType
{
    /**
     * @var string
     *
     * @ORM\Column(name="font_type_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fontTypeCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="font_type_libelle", type="string", length=100, nullable=true)
     */
    private $fontTypeLibelle;

    public function getFontTypeCode(): ?string
    {
        return $this->fontTypeCode;
    }

    public function setFontTypeCode(?string $fontTypeCode): self
    {
        $this->fontTypeCode = $fontTypeCode;

        return $this;
    }

    public function getFontTypeLibelle(): ?string
    {
        return $this->fontTypeLibelle;
    }

    public function setFontTypeLibelle(?string $fontTypeLibelle): self
    {
        $this->fontTypeLibelle = $fontTypeLibelle;

        return $this;
    }


}
