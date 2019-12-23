<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** 
 * Cr_be_detail
 * @ORM\Table(name="Cr_be_detail")
 * @ORM\Entity 
 */
class Cr_be_detail
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string|null
	 * @ORM\Column(name="serie", type="string", length=100, nullable=true)
	 */
	private $serie;

	/**
	 * @var integer|null
	 * @ORM\Column(name="pnbe", type="integer", length=100, nullable=true)
	 */
	private $pnbe;

	/**
	 * @var integer|null
	 * @ORM\Column(name="dnbe", type="integer", length=100, nullable=true)
	 */
	private $dnbe;

	/**
	 * @var \Cr_be_entete
	 * @ORM\ManyToOne(targetEntity="Cr_be_entete",inversedBy="nbeColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="nbe", referencedColumnName="nbe")
	 * })
	 */
	private $nbe;

	/**
	 * @var \Cr_titres
	 * @ORM\ManyToOne(targetEntity="Cr_titres",inversedBy="titreColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="titre", referencedColumnName="titre")
	 * })
	 */
	private $titre;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setId($id)
                                       	{
                                       		$this->id = $id; return $this;
                                       	}

    public function getId(): ?int
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

    public function getPnbe(): ?int
    {
        return $this->pnbe;
    }

    public function setPnbe(?int $pnbe): self
    {
        $this->pnbe = $pnbe;

        return $this;
    }

    public function getDnbe(): ?int
    {
        return $this->dnbe;
    }

    public function setDnbe(?int $dnbe): self
    {
        $this->dnbe = $dnbe;

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

    public function getNbe(): ?Cr_be_entete
    {
        return $this->nbe;
    }

    public function setNbe(?Cr_be_entete $nbe): self
    {
        $this->nbe = $nbe;

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
}
