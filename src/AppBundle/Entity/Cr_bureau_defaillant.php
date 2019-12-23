<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cr_bureau_defaillant
 * @ORM\Table(name="Cr_bureau_defaillant")
 * @ORM\Entity
 */  
class Cr_bureau_defaillant
{
	/**
	 * @var int
	 * @ORM\Column(name="id", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")   
	 */
	private $id;

	/**
	 * @var \Cr_titres
	 * @ORM\ManyToOne(targetEntity="Cr_titres",inversedBy="titreColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="titre", referencedColumnName="titre")
	 * })
	 */
	private $titre;

	/**
	 * @var string|null
	 * @ORM\Column(name="serie", type="string", length=100, nullable=true)
	 */
	private $serie;

	/**
	 * @var integer|null
	 * @ORM\Column(name="pndef", type="integer", length=100, nullable=true)
	 */
	private $pndef;

	/**
	 * @var integer|null
	 * @ORM\Column(name="dndef", type="integer", length=100, nullable=true)
	 */
	private $dndef;

	/**
	 * @var datetime|null
	 * @ORM\Column(name="date_def", type="datetime", length=100, nullable=true)
	 */
	private $dateDef;

	/**
	 * @var string|null
	 * @ORM\Column(name="motif", type="string", length=100, nullable=true)
	 */
	private $motif;

	/**
	 * @var \Cr_be_entete
	 * @ORM\ManyToOne(targetEntity="Cr_be_entete",inversedBy="nbeColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="nbe", referencedColumnName="nbe")
	 * })
	 */
	private $nbe;


	public function setId($id)
                                             	{
                                             		$this->id = $id; return $this;
                                             	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(?string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getPndef(): ?int
    {
        return $this->pndef;
    }

    public function setPndef(?int $pndef): self
    {
        $this->pndef = $pndef;

        return $this;
    }

    public function getDndef(): ?int
    {
        return $this->dndef;
    }

    public function setDndef(?int $dndef): self
    {
        $this->dndef = $dndef;

        return $this;
    }

    public function getDateDef(): ?\DateTimeInterface
    {
        return $this->dateDef;
    }

    public function setDateDef(?\DateTimeInterface $dateDef): self
    {
        $this->dateDef = $dateDef;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getTitre(): ?Cr_titres
    {
        return $this->titre;
    }

    public function setTitre(?Cr_titres $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbe(): ?Cr_be_entete
    {
        return $this->nbe;
    }

    public function setNbe(?Cr_be_entete $nbe): self
    {
        $this->nbe = $nbe;

        return $this;
    }
}
