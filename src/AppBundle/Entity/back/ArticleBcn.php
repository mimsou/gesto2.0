<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleBcn
 * @ORM\Table(name="article_bcn")
 * @ORM\Entity
 */
class ArticleBcn
{
	/**
	 * @var string
	 * @ORM\Column(name="article_bcn_detail_code", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $articleBcnDetailCode;

	/**
	 * @var float|null
	 * @ORM\Column(name="article_bcn_qte_dem", type="float", length=100, nullable=true)
	 */
	private $articleBcnQteDem;

	/**
	 * @var float|null
	 * @ORM\Column(name="article_bcn_qte_valider", type="float", length=100, nullable=true)
	 */
	private $articleBcnQteValider;

	/**
	 * @var float|null
	 * @ORM\Column(name="article_bcn_qte_facture", type="float", length=100, nullable=true)
	 */
	private $articleBcnQteFacture;

	/**
	 * @var float|null
	 * @ORM\Column(name="article_bcn_prix_unitaire", type="float", length=100, nullable=true)
	 */
	private $articleBcnPrixUnitaire;

	/**
	 * @var float|null
	 * @ORM\Column(name="article_bcn_prix_ttc", type="float", length=100, nullable=true)
	 */
	private $articleBcnPrixTtc;

	/**
	 * @var integer|null
	 * @ORM\Column(name="article_bcn_etat", type="integer", length=100, nullable=true)
	 */
	private $articleBcnEtat;

	/**
	 * @var \Article
	 * @ORM\ManyToOne(targetEntity="Article",inversedBy="articleDetail")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="article_bcn_code", referencedColumnName="article_code")
	 * })
	 */
	private $articleBcnCode;

	/**
	 * @var \Bcn
	 * @ORM\ManyToOne(targetEntity="Bcn",inversedBy="detailBcn")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="bcn_code", referencedColumnName="bcn_code")
	 * })
	 */
	private $bcnCode;

	/**
	 * @var \Facture
	 * @ORM\ManyToOne(targetEntity="Facture",inversedBy="detailFacture")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="facture_code_regrouppement", referencedColumnName="facture_code")
	 * })
	 */
	private $factureCodeRegrouppement;

	/**
	 * @var string|null
	 * @ORM\Column(name="article_bcn_affectation", type="string", length=100, nullable=true)
	 */
	private $articleBcnAffectation;


	public function setArticleBcnDetailCode($articleBcnDetailCode)
                                                               	{
                                                               		$this->articleBcnDetailCode = $articleBcnDetailCode; return $this;
                                                               	}

    public function getArticleBcnDetailCode(): ?int
    {
        return $this->articleBcnDetailCode;
    }

    public function getArticleBcnQteDem(): ?float
    {
        return $this->articleBcnQteDem;
    }

    public function setArticleBcnQteDem(?float $articleBcnQteDem): self
    {
        $this->articleBcnQteDem = $articleBcnQteDem;

        return $this;
    }

    public function getArticleBcnQteValider(): ?float
    {
        return $this->articleBcnQteValider;
    }

    public function setArticleBcnQteValider(?float $articleBcnQteValider): self
    {
        $this->articleBcnQteValider = $articleBcnQteValider;

        return $this;
    }

    public function getArticleBcnQteFacture(): ?float
    {
        return $this->articleBcnQteFacture;
    }

    public function setArticleBcnQteFacture(?float $articleBcnQteFacture): self
    {
        $this->articleBcnQteFacture = $articleBcnQteFacture;

        return $this;
    }

    public function getArticleBcnPrixUnitaire(): ?float
    {
        return $this->articleBcnPrixUnitaire;
    }

    public function setArticleBcnPrixUnitaire(?float $articleBcnPrixUnitaire): self
    {
        $this->articleBcnPrixUnitaire = $articleBcnPrixUnitaire;

        return $this;
    }

    public function getArticleBcnPrixTtc(): ?float
    {
        return $this->articleBcnPrixTtc;
    }

    public function setArticleBcnPrixTtc(?float $articleBcnPrixTtc): self
    {
        $this->articleBcnPrixTtc = $articleBcnPrixTtc;

        return $this;
    }

    public function getArticleBcnEtat(): ?int
    {
        return $this->articleBcnEtat;
    }

    public function setArticleBcnEtat(?int $articleBcnEtat): self
    {
        $this->articleBcnEtat = $articleBcnEtat;

        return $this;
    }

    public function getArticleBcnAffectation(): ?string
    {
        return $this->articleBcnAffectation;
    }

    public function setArticleBcnAffectation(?string $articleBcnAffectation): self
    {
        $this->articleBcnAffectation = $articleBcnAffectation;

        return $this;
    }

    public function getArticleBcnCode(): ?Article
    {
        return $this->articleBcnCode;
    }

    public function setArticleBcnCode(?Article $articleBcnCode): self
    {
        $this->articleBcnCode = $articleBcnCode;

        return $this;
    }

    public function getBcnCode(): ?Bcn
    {
        return $this->bcnCode;
    }

    public function setBcnCode(?Bcn $bcnCode): self
    {
        $this->bcnCode = $bcnCode;

        return $this;
    }

    public function getFactureCodeRegrouppement(): ?Facture
    {
        return $this->factureCodeRegrouppement;
    }

    public function setFactureCodeRegrouppement(?Facture $factureCodeRegrouppement): self
    {
        $this->factureCodeRegrouppement = $factureCodeRegrouppement;

        return $this;
    }
}
