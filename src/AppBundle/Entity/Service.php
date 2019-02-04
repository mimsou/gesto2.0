<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="fk_service_crb1_idx", columns={"service_code_crb"}), @ORM\Index(name="fk_service_fond_type1_idx", columns={"service_type_fond_code"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var string
     *
     * @ORM\Column(name="service_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $serviceCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="service_libelle", type="string", length=100, nullable=true)
     */
    private $serviceLibelle;

    /**
     * @var \Crb
     *
     * @ORM\ManyToOne(targetEntity="Crb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_code_crb", referencedColumnName="crb_code")
     * })
     */
    private $serviceCodeCrb;

    /**
     * @var \FondType
     *
     * @ORM\ManyToOne(targetEntity="FondType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_type_fond_code", referencedColumnName="font_type_code")
     * })
     */
    private $serviceTypeFondCode;

    public function getServiceCode(): ?string
    {
        return $this->serviceCode;
    }

    public function setServiceCode(?string $serviceCode): self
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }

    public function getServiceLibelle(): ?string
    {
        return $this->serviceLibelle;
    }

    public function setServiceLibelle(?string $serviceLibelle): self
    {
        $this->serviceLibelle = $serviceLibelle;

        return $this;
    }

    public function getServiceCodeCrb(): ?Crb
    {
        return $this->serviceCodeCrb;
    }

    public function setServiceCodeCrb(?Crb $serviceCodeCrb): self
    {
        $this->serviceCodeCrb = $serviceCodeCrb;

        return $this;
    }

    public function getServiceTypeFondCode(): ?FondType
    {
        return $this->serviceTypeFondCode;
    }

    public function setServiceTypeFondCode(?FondType $serviceTypeFondCode): self
    {
        $this->serviceTypeFondCode = $serviceTypeFondCode;

        return $this;
    }


}
