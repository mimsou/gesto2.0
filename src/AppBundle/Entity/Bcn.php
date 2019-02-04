<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bcn
 *
 * @ORM\Table(name="bcn", indexes={@ORM\Index(name="fk_bcn_facture1_idx", columns={"bcn_code_regrouppement"}), @ORM\Index(name="fk_bcn_facture1", columns={"bcn_code_regrouppement"}), @ORM\Index(name="fk_bcn_service1_idx", columns={"bcn_code_service"})})
 * @ORM\Entity
 */
class Bcn
{
    /**
     * @var string
     *
     * @ORM\Column(name="bcn_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bcnCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ArticleBcn", mappedBy="bcnCode" , cascade={"persist"})
     */
    private $detailBcn;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bcn_date_creation", type="datetime", nullable=true)
     */
    private $bcnDateCreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="bcn_date_validation", type="datetime", nullable=true)
     */
    private $bcnDateValidation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="bcn_exercice", type="integer", nullable=true)
     */
    private $bcnExercice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="bcn_etat", type="integer", nullable=true)
     */
    private $bcnEtat;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_code_regrouppement", referencedColumnName="facture_code")
     * })
     */
    private $bcnCodeRegrouppement;

    /**
     * @var \Service
     *
     * @ORM\ManyToOne(targetEntity="Service")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_code_service", referencedColumnName="service_code")
     * })
     */
    private $bcnCodeService;

    public function __construct()
    {
        $this->detailBcn = new ArrayCollection();
    }




    public function getBcnCode(): ?string
    {
        return $this->bcnCode;
    }

    public function setBcnCode($bcnCode): self
    {
        $this->bcnCode = $bcnCode;

        return $this;
    }

    public function getBcnDateCreation(): ?\DateTimeInterface
    {
        return $this->bcnDateCreation;
    }

    public function setBcnDateCreation(?\DateTimeInterface $bcnDateCreation): self
    {
        $this->bcnDateCreation = $bcnDateCreation;

        return $this;
    }

    public function getBcnDateValidation(): ?\DateTimeInterface
    {
        return $this->bcnDateValidation;
    }

    public function setBcnDateValidation(?\DateTimeInterface $bcnDateValidation): self
    {
        $this->bcnDateValidation = $bcnDateValidation;

        return $this;
    }

    public function getBcnExercice(): ?int
    {
        return $this->bcnExercice;
    }

    public function setBcnExercice(?int $bcnExercice): self
    {
        $this->bcnExercice = $bcnExercice;

        return $this;
    }

    public function getBcnEtat(): ?int
    {
        return $this->bcnEtat;
    }

    public function setBcnEtat(?int $bcnEtat): self
    {
        $this->bcnEtat = $bcnEtat;

        return $this;
    }

    public function getBcnCodeRegrouppement(): ?Facture
    {
        return $this->bcnCodeRegrouppement;
    }

    public function setBcnCodeRegrouppement(?Facture $bcnCodeRegrouppement): self
    {
        $this->bcnCodeRegrouppement = $bcnCodeRegrouppement;

        return $this;
    }

    public function getBcnCodeService(): ?Service
    {
        return $this->bcnCodeService;
    }

    public function setBcnCodeService(?Service $bcnCodeService): self
    {
        $this->bcnCodeService = $bcnCodeService;

        return $this;
    }

    /**
     * @return Collection|ArticleBcn[]
     */
    public function getDetailBcn(): Collection
    {
        return $this->detailBcn;
    }

    public function addDetailBcn(ArticleBcn $detailBcn): self
    {
        if (!$this->detailBcn->contains($detailBcn)) {
            $this->detailBcn[] = $detailBcn;
            $detailBcn->setBcnCode($this);
        }

        return $this;
    }

    public function removeDetailBcn(ArticleBcn $detailBcn): self
    {
        if ($this->detailBcn->contains($detailBcn)) {
            $this->detailBcn->removeElement($detailBcn);
            // set the owning side to null (unless already changed)
            if ($detailBcn->getBcnCode() === $this) {
                $detailBcn->setBcnCode(null);
            }
        }

        return $this;
    }


}
