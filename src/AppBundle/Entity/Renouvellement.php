<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Renouvellement
 * @ORM\Table(name="renouvellement")
 * @ORM\Entity
 */
class Renouvellement
{
	/**
	 * @var string
	 * @ORM\Column(name="renouvellement_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $renouvellementCode;

	/**
	 * @var integer|null
	 * @ORM\Column(name="renouvellement_etat", type="integer", length=100, nullable=true)
	 */
	private $renouvellementEtat;  

	/**
	 * @var \Exercice
	 * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="renouvellement")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="renouvellement_exercice", referencedColumnName="exercice_code")
	 * }) 
	 */
	private $renouvellementExercice;

	/**
	 * @var \Crb
	 * @ORM\ManyToOne(targetEntity="Crb",inversedBy="crbRenouvellement")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="renouvellement_code_crb", referencedColumnName="crb_code")
	 * })
	 */
	private $renouvellementCodeCrb;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="renouvellement_date_validation", type="datetime", length=100, nullable=true)
	 */
	private $renouvellementDateValidation;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="renouvellement_date_reglement", type="datetime", length=100, nullable=true)
	 */
	private $renouvellementDateReglement;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 * @ORM\OneToMany(targetEntity="Facture", mappedBy="factureCodeRenouvellement" , cascade={"persist"})
	 */
	private $detailrenouvellement;

    public function __construct()
    {
        $this->detailrenouvellement = new ArrayCollection();
    }


	public function setRenouvellementCode($renouvellementCode)
     {
       $this->renouvellementCode = $renouvellementCode; return $this;
      }

    public function getRenouvellementCode(): ?string
    {
        return $this->renouvellementCode;
    }

    public function getRenouvellementEtat(): ?int
    {
        return $this->renouvellementEtat;
    }

    public function setRenouvellementEtat(?int $renouvellementEtat): self
    {
        $this->renouvellementEtat = $renouvellementEtat;

        return $this;
    }

    public function getRenouvellementDateValidation(): ?\DateTimeInterface
    {
        return $this->renouvellementDateValidation;
    }

    public function setRenouvellementDateValidation(?\DateTimeInterface $renouvellementDateValidation): self
    {
        $this->renouvellementDateValidation = $renouvellementDateValidation;

        return $this;
    }

    public function getRenouvellementDateReglement(): ?\DateTimeInterface
    {
        return $this->renouvellementDateReglement;
    }

    public function setRenouvellementDateReglement(?\DateTimeInterface $renouvellementDateReglement): self
    {
        $this->renouvellementDateReglement = $renouvellementDateReglement;

        return $this;
    }

    public function getRenouvellementExercice(): ?Exercice
    {
        return $this->renouvellementExercice;
    }

    public function setRenouvellementExercice(?Exercice $renouvellementExercice): self
    {
        $this->renouvellementExercice = $renouvellementExercice;

        return $this;
    }

    public function getRenouvellementCodeCrb(): ?Crb
    {
        return $this->renouvellementCodeCrb;
    }

    public function setRenouvellementCodeCrb(?Crb $renouvellementCodeCrb): self
    {
        $this->renouvellementCodeCrb = $renouvellementCodeCrb;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getDetailrenouvellement(): Collection
    {
        return $this->detailrenouvellement;
    }

    public function addDetailrenouvellement(Facture $detailrenouvellement): self
    {
        if (!$this->detailrenouvellement->contains($detailrenouvellement)) {
            $this->detailrenouvellement[] = $detailrenouvellement;
            $detailrenouvellement->setFactureCodeRenouvellement($this);
        }

        return $this;
    }

    public function removeDetailrenouvellement(Facture $detailrenouvellement): self
    {
        if ($this->detailrenouvellement->contains($detailrenouvellement)) {
            $this->detailrenouvellement->removeElement($detailrenouvellement);
            // set the owning side to null (unless already changed)
            if ($detailrenouvellement->getFactureCodeRenouvellement() === $this) {
                $detailrenouvellement->setFactureCodeRenouvellement(null);
            }
        }

        return $this;
    }
}
