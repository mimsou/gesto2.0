<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestActions
 *
 * @ORM\Table(name="gest_actions_regle")
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
    private $acregId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acreg_name", type="string", length=150, nullable=true)
     */
    private $acregName;

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
     * @var string|null
     *
     * @ORM\Column(name="acreg_expression", type="string", length=2000, nullable=true)
     */
    private $acregExpression;


    /**
     * @var \GestActions
     *
     * @ORM\ManyToOne(targetEntity="GestActions" ,inversedBy="actionAcreg")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acreg_action", referencedColumnName="action_id"  )
     * })
     */
    private $acregAction;




    /**
     * Constructor
     */
    public function __construct()
    {

    }

    public function getAcregId(): ?int
    {
        return $this->acregId;
    }

    public function getAcregName(): ?string
    {
        return $this->acregName;
    }

    public function setAcregName(?string $acregName): self
    {
        $this->acregName = $acregName;

        return $this;
    }

    public function getAcregExpression(): ?string
    {
        return $this->acregExpression;
    }

    public function setAcregExpression(?string $acregExpression): self
    {
        $this->acregExpression = $acregExpression;

        return $this;
    }

    public function getAcregAction(): ?GestActions
    {
        return $this->acregAction;
    }

    public function setAcregAction(?GestActions $acregAction): self
    {
        $this->acregAction = $acregAction;

        return $this;
    }

    public function getAcregAlias(): ?string
    {
        return $this->acregAlias;
    }

    public function setAcregAlias(?string $acregAlias): self
    {
        $this->acregAlias = $acregAlias;

        return $this;
    }

    public function getAcregErrormessage(): ?string
    {
        return $this->acregErrormessage;
    }

    public function setAcregErrormessage(?string $acregErrormessage): self
    {
        $this->acregErrormessage = $acregErrormessage;

        return $this;
    }

}
