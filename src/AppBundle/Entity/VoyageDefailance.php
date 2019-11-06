<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * VoyageDefailance
 * @ORM\Table(name="VoyageDefailance")
 * @ORM\Entity
 */
class VoyageDefailance
{
	/**
	 * @var float|null
	 * @ORM\Column(name="nbre_voy", type="float", length=100, nullable=true)
	 */
	private $nbreVoy;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;

	/**
	 * @var string
	 * @ORM\Column(name="jour", type="date", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $jour;

	/**
	 * @var \TypeDefaillance
	 * @ORM\ManyToOne(targetEntity="TypeDefaillance")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_type_def", referencedColumnName="code_type_def")
	 * })
	 */
	private $codeTypeDef;

	/**
	 * @var \Defailance
	 * @ORM\ManyToOne(targetEntity="Defailance")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_defaillance", referencedColumnName="code_defaillance")
	 * })
	 */
	private $codeDefaillance;

	/**
	 * @var \PlageHoraire
	 * @ORM\ManyToOne(targetEntity="PlageHoraire")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_hr", referencedColumnName="code_hr")
	 * })
	 */
	private $codeHr;


	public function setJour($jour)
                                 	{
                                 		$this->jour = $jour; return $this;
                                 	}

    public function getNbreVoy(): ?float
    {
        return $this->nbreVoy;
    }

    public function setNbreVoy(?float $nbreVoy): self
    {
        $this->nbreVoy = $nbreVoy;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(?int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function getCodeTypeDef(): ?TypeDefaillance
    {
        return $this->codeTypeDef;
    }

    public function setCodeTypeDef(?TypeDefaillance $codeTypeDef): self
    {
        $this->codeTypeDef = $codeTypeDef;

        return $this;
    }

    public function getCodeDefaillance(): ?Defailance
    {
        return $this->codeDefaillance;
    }

    public function setCodeDefaillance(?Defailance $codeDefaillance): self
    {
        $this->codeDefaillance = $codeDefaillance;

        return $this;
    }

    public function getCodeHr(): ?PlageHoraire
    {
        return $this->codeHr;
    }

    public function setCodeHr(?PlageHoraire $codeHr): self
    {
        $this->codeHr = $codeHr;

        return $this;
    }
}
