<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * UpdateForm
 *
 * @ORM\Table(name="update_form")
 * @ORM\Entity
 */
class UpdateForm
{

    /**
     * @var \GestEntity
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestActions" , inversedBy="updateField"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="update_action_id", referencedColumnName="action_id")
     * })
     */
    private $updateActionId;


    /**
     * @var \GestEntity
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="GestFields" , inversedBy="updateAction"   )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="update_field_id", referencedColumnName="field_id")
     * })
     */
    private $updateFieldId;


    /**
     * @var string|null
     *
     * @ORM\Column(name="update_condition", type="string",  nullable=true)
     */
    private $updateCondition;



    /**
     * @var integer|null
     *
     * @ORM\Column(name="update_require", type="integer",  nullable=true)
     */
    private $updateRequire;



    /**
     * @var string|null
     *
     * @ORM\Column(name="update_expression", type="string",   nullable=true)
     */
    private $updateExpression;

    public function getUpdateActionId(): ?GestActions
    {
        return $this->updateActionId;
    }

    public function setUpdateActionId(?GestActions $updateActionId): self
    {
        $this->updateActionId = $updateActionId;

        return $this;
    }

    public function getUpdateFieldId(): ?GestFields
    {
        return $this->updateFieldId;
    }

    public function setUpdateFieldId(?GestFields $updateFieldId): self
    {
        $this->updateFieldId = $updateFieldId;

        return $this;
    }

    public function getUpdateCondition(): ?string
    {
        return $this->updateCondition;
    }

    public function setUpdateCondition(?string $updateCondition): self
    {
        $this->updateCondition = $updateCondition;

        return $this;
    }

    public function getUpdateExpression(): ?string
    {
        return $this->updateExpression;
    }

    public function setUpdateExpression(?string $updateExpression): self
    {
        $this->updateExpression = $updateExpression;

        return $this;
    }

    public function getUpdateRequire(): ?int
    {
        return $this->updateRequire;
    }

    public function setUpdateRequire(?int $updateRequire): self
    {
        $this->updateRequire = $updateRequire;

        return $this;
    }


}