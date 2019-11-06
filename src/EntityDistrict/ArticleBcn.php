<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleBcn
 *
 * @ORM\Table(name="article_bcn", indexes={@ORM\Index(name="inx_frei_key", columns={"bcn_code"}), @ORM\Index(name="IDX_C2D7911DC89F6915", columns={"facture_code_regrouppement"}), @ORM\Index(name="fk_article_bcn_article1_idx", columns={"article_bcn_code"}), @ORM\Index(name="inx_uniq_key", columns={"bcn_code", "article_bcn_code"})})
 * @ORM\Entity
 */
class ArticleBcn
{
    /**
     * @var int
     *
     * @ORM\Column(name="article_bcn_detail_code", type="integer", nullable=false)
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
     * @var \Bcn
     *
     * @ORM\ManyToOne(targetEntity="Bcn")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bcn_code", referencedColumnName="bcn_code")
     * })
     */
    private $bcnCode;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_bcn_code", referencedColumnName="article_code")
     * })
     */
    private $articleBcnCode;

    /**
     * @var \Facture
     *
     * @ORM\ManyToOne(targetEntity="Facture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_code_regrouppement", referencedColumnName="facture_code")
     * })
     */
    private $factureCodeRegrouppement;


}
