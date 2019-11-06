<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestActionsRegle
 *
 * @ORM\Table(name="gest_actions_regle", indexes={@ORM\Index(name="IDX_520596731CE19AB2", columns={"acreg_action"})})
 * @ORM\Entity
 */
class GestActionsRegle
{
    /**
     * @var int
     *
     * @ORM\Column(name="acregId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $acregid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acreg_name", type="string", length=150, nullable=true)
     */
    private $acregName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acreg_expression", type="string", length=2000, nullable=true)
     */
    private $acregExpression;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acreg_alias", type="string", length=150, nullable=true)
     */
    private $acregAlias;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acreg_errormessage", type="string", length=1000, nullable=true)
     */
    private $acregErrormessage;

    /**
     * @var \GestActions
     *
     * @ORM\ManyToOne(targetEntity="GestActions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acreg_action", referencedColumnName="action_id")
     * })
     */
    private $acregAction;


}
