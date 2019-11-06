<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestListRegle
 *
 * @ORM\Table(name="gest_list_regle", indexes={@ORM\Index(name="IDX_77FF85698E76A3A", columns={"reg_list"})})
 * @ORM\Entity
 */
class GestListRegle
{
    /**
     * @var int
     *
     * @ORM\Column(name="listreg_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $listregId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="listreg_name", type="string", length=150, nullable=true)
     */
    private $listregName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="listreg_alias", type="string", length=150, nullable=true)
     */
    private $listregAlias;

    /**
     * @var string|null
     *
     * @ORM\Column(name="listreg_expression", type="string", length=2000, nullable=true)
     */
    private $listregExpression;

    /**
     * @var \GestList
     *
     * @ORM\ManyToOne(targetEntity="GestList")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reg_list", referencedColumnName="list_id")
     * })
     */
    private $regList;


}
