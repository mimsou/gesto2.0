<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Crb
 *
 * @ORM\Table(name="crb")
 * @ORM\Entity
 */
class Crb
{
    /**
     * @var string
     *
     * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $crbCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="crb_libelle", type="string", length=100, nullable=true)
     */
    private $crbLibelle;

    /**
     * @var float|null
     *
     * @ORM\Column(name="crb_solde", type="float", precision=10, scale=0, nullable=true)
     */
    private $crbSolde;

    /**
     * @var int|null
     *
     * @ORM\Column(name="crb_etat", type="integer", nullable=true)
     */
    private $crbEtat;

    /**
     * @var float|null
     *
     * @ORM\Column(name="fond", type="float", precision=10, scale=0, nullable=true)
     */
    private $fond;

    /**
     * @var float|null
     *
     * @ORM\Column(name="som_facture", type="float", precision=10, scale=0, nullable=true)
     */
    private $somFacture;

    /**
     * @var float|null
     *
     * @ORM\Column(name="somrenouvellement", type="float", precision=10, scale=0, nullable=true)
     */
    private $somrenouvellement;


}
