<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", uniqueConstraints={@ORM\UniqueConstraint(name="facture_code_regroupement_UNIQUE", columns={"facture_code_regroupement"})}, indexes={@ORM\Index(name="fk_facture_renouvellement1_idx", columns={"facture_code_renouvellement"}), @ORM\Index(name="IDX_FE866410F6E7C9BC", columns={"facture_exercice"}), @ORM\Index(name="IDX_FE866410F1BA8E30", columns={"facture_code_crb"}), @ORM\Index(name="fk_facture_fournisseur1_idx", columns={"facture_code_fournisseur"})})
 * @ORM\Entity
 */
class Facture
{
    /**
     * @var string
     *
     * @ORM\Column(name="facture_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $factureCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facture_numeo_bl", type="string", length=20, nullable=true)
     */
    private $factureNumeoBl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facture_code_regroupement", type="string", length=10, nullable=true)
     */
    private $factureCodeRegroupement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="facture_code_devis", type="string", length=10, nullable=true)
     */
    private $factureCodeDevis;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="facture_date_devis", type="datetime", nullable=true)
     */
    private $factureDateDevis;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="facture_date_reception", type="datetime", nullable=true)
     */
    private $factureDateReception;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="facture_date_validation", type="datetime", nullable=true)
     */
    private $factureDateValidation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="facture_etat", type="integer", nullable=true)
     */
    private $factureEtat;

    /**
     * @var \Fournisseur
     *
     * @ORM\ManyToOne(targetEntity="Fournisseur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_code_fournisseur", referencedColumnName="fournisseur_code")
     * })
     */
    private $factureCodeFournisseur;

    /**
     * @var \Renouvellement
     *
     * @ORM\ManyToOne(targetEntity="Renouvellement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_code_renouvellement", referencedColumnName="renouvellement_code")
     * })
     */
    private $factureCodeRenouvellement;

    /**
     * @var \Crb
     *
     * @ORM\ManyToOne(targetEntity="Crb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_code_crb", referencedColumnName="crb_code")
     * })
     */
    private $factureCodeCrb;

    /**
     * @var \Exercice
     *
     * @ORM\ManyToOne(targetEntity="Exercice")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="facture_exercice", referencedColumnName="exercice_code")
     * })
     */
    private $factureExercice;


}
