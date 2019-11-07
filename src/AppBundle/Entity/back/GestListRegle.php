<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestListRegle
 *
 * @ORM\Table(name="gest_list_regle")
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
     * @ORM\ManyToOne(targetEntity="GestList" ,inversedBy="listReg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reg_list", referencedColumnName="list_id"  )
     * })
     */
    private $regList;

    public function getListregId(): ?int
    {
        return $this->listregId;
    }

    public function getListregName(): ?string
    {
        return $this->listregName;
    }

    public function setListregName(?string $listregName): self
    {
        $this->listregName = $listregName;

        return $this;
    }

    public function getListregAlias(): ?string
    {
        return $this->listregAlias;
    }

    public function setListregAlias(?string $listregAlias): self
    {
        $this->listregAlias = $listregAlias;

        return $this;
    }

    public function getListregExpression(): ?string
    {
        return $this->listregExpression;
    }

    public function setListregExpression(?string $listregExpression): self
    {
        $this->listregExpression = $listregExpression;

        return $this;
    }

    public function getRegList(): ?GestList
    {
        return $this->regList;
    }

    public function setRegList(?GestList $regList): self
    {
        $this->regList = $regList;

        return $this;
    }

}
