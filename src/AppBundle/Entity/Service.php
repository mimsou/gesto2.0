<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service", indexes={@ORM\Index(name="IDX_2E20A34E42BDE7F4", columns={"service_type_fond"}), @ORM\Index(name="IDX_2E20A34E1A33DBFC", columns={"service_code_crb"})})
 * @ORM\Entity
 */
class Service
{
    /**
     * @var string
     *
     * @ORM\Column(name="service_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var \Fondtype
     *
     * @ORM\ManyToOne(targetEntity="Fondtype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="service_type_fond", referencedColumnName="font_type_code")
     * })
     */
    private $serviceTypeFond;

    public function getServiceCode(): ?string
    {
        return $this->serviceCode;
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

    public function getServiceTypeFond(): ?Fondtype
    {
        return $this->serviceTypeFond;
    }

    public function setServiceTypeFond(?Fondtype $serviceTypeFond): self
    {
        $this->serviceTypeFond = $serviceTypeFond;

        return $this;
    }


}
