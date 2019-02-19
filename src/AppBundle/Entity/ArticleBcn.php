<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleBcn
 *
 * @ORM\Table(name="article_bcn", indexes={@ORM\Index(name="inx_uniq_key", columns={"bcn_code", "article_bcn_code"}), @ORM\Index(name="fk_article_bcn_article1_idx", columns={"article_bcn_code"}), @ORM\Index(name="inx_frei_key", columns={"bcn_code"})})
 * @ORM\Entity
 */
class ArticleBcn
{
    /**
     * @var string
     *
     * @ORM\Column(name="article_bcn_detail_code", type="integer", length=200, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $articleBcnDetailCode;



    /**
     * @var float|null
     *
     * @ORM\Column(name="article_bcn_qte_dem", type="float", precision=10, scale=0, nullable=true)
     */
    private $articleBcnQteDem;

    /**
     * @var float|null
     *
     * @ORM\Column(name="article_bcn_qte_valider", type="float", precision=10, scale=0, nullable=true)
     */
    private $articleBcnQteValider;

    /**
     * @var float|null
     *
     * @ORM\Column(name="article_bcn_qte_facture", type="float", precision=10, scale=0, nullable=true)
     */
    private $articleBcnQteFacture;

    /**
     * @var float|null
     *
     * @ORM\Column(name="article_bcn_prix_unitaire", type="float", precision=10, scale=0, nullable=true)
     */
    private $articleBcnPrixUnitaire;

    /**
     * @var float|null
     *
     * @ORM\Column(name="article_bcn_prix_ttc", type="float", precision=10, scale=0, nullable=true)
     */
    private $articleBcnPrixTtc;

    /**
     * @var int|null
     *
     * @ORM\Column(name="article_bcn_etat", type="integer", nullable=true)
     */
    private $articleBcnEtat;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article" , inversedBy="articleDetail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_bcn_code", referencedColumnName="article_code")
     * })
     */
    private $articleBcnCode;

    /**
     * @var \Bcn
     *
     * @ORM\ManyToOne(targetEntity="Bcn" , inversedBy="detailBcn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_code", referencedColumnName="bcn_code")
     * })
     */
    private $bcnCode;

    public function getArticleBcnDetailCode(): ?int
    {
        return $this->articleBcnDetailCode;
    }

    public function getArticleBcncol(): ?string
    {
        return $this->articleBcncol;
    }

    public function setArticleBcncol(?string $articleBcncol): self
    {
        $this->articleBcncol = $articleBcncol;

        return $this;
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


}
