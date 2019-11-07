<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bcn
 * @ORM\Table(name="bcn")
 * @ORM\Entity
 */
class Bcn
{
	/**
	 * @var string
	 * @ORM\Column(name="bcn_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $bcnCode;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="bcn_date_creation", type="datetime", length=100, nullable=true)
	 */
	private $bcnDateCreation;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="bcn_date_validation", type="datetime", length=100, nullable=true)
	 */
	private $bcnDateValidation;

	/**
	 * @var integer|null
	 * @ORM\Column(name="bcn_etat", type="integer", length=100, nullable=true)
	 */
	private $bcnEtat;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="ArticleBcn", mappedBy="bcnCode" , cascade={"persist"})
	 */
	private $detailBcn;

	/**
	 * @var \Exercice
	 * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="bcn")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="bcn_exercice", referencedColumnName="exercice_code")
	 * })
	 */
	private $bcnExercice;

	/**
	 * @var \Service
	 * @ORM\ManyToOne(targetEntity="Service")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="bcn_code_service", referencedColumnName="service_code")
	 * })
	 */
	private $bcnCodeService;

	/**
	 * @var string|null
	 * @ORM\Column(name="sum_prix_facture", type="string", length=100, nullable=true)
	 */
	private $sumPrixFacture;

    public function __construct()
    {
        $this->detailBcn = new ArrayCollection();
    }


	public function setBcnCode($bcnCode)
                                                      	{
                                                      		$this->bcnCode = $bcnCode; return $this;
                                                      	}

    public function getBcnCode(): ?string
    {
        return $this->bcnCode;
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

    public function getBcnEtat(): ?int
    {
        return $this->bcnEtat;
    }

    public function setBcnEtat(?int $bcnEtat): self
    {
        $this->bcnEtat = $bcnEtat;

        return $this;
    }

    public function getSumPrixFacture(): ?string
    {
        return $this->sumPrixFacture;
    }

    public function setSumPrixFacture(?string $sumPrixFacture): self
    {
        $this->sumPrixFacture = $sumPrixFacture;

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

    public function getBcnExercice(): ?Exercice
    {
        return $this->bcnExercice;
    }

    public function setBcnExercice(?Exercice $bcnExercice): self
    {
        $this->bcnExercice = $bcnExercice;

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
}
