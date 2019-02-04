<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestActions
 *
 * @ORM\Table(name="gest_actions")
 * @ORM\Entity
 */
class GestActions
{
    /**
     * @var int
     *
     * @ORM\Column(name="action_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $actionId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_name", type="string", length=150, nullable=true)
     */
    private $actionName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="action")
     */
    private $role;


    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_sub_process", referencedColumnName="process_id"  )
     * })
     */
    private $actionSubProcess;


    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_sub_entity", referencedColumnName="entity_id")
     * })
     */
    private $actionSubEntity;


    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_entity", referencedColumnName="entity_id")
     * })
     */
    private $actionEntity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_btn_name", type="string", length=150, nullable=true)
     */
    private $actionBtnName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="action_type", type="integer", nullable=true)
     */
    private $actionType;

    /**
     * @var int|null
     *
     * @ORM\Column(name="action_existing_sub_entity", type="integer", nullable=true)
     */
    private $actionExistingSubEntity;


    /**
     * @var int|null
     *
     * @ORM\Column(name="action_add_sub_entity", type="integer", nullable=true)
     */
    private $actionAddSubEntity;


    /**
     * @var int|null
     *
     * @ORM\Column(name="action_ismain_level", type="integer", nullable=true)
     */
    private $actionIsmainLevel;


    /**
     * @var int|null
     *
     * @ORM\Column(name="action_level_depth", type="integer", nullable=true)
     */
    private $actionLevelDepth;



    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess",inversedBy="actions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_process", referencedColumnName="process_id"  )
     * })
     */
    private $actionProcess;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", mappedBy="action" , cascade={"persist"})
     */
    private $step;


    /**
     * @var \GestSteps
     *
     * @ORM\ManyToOne(targetEntity="GestSteps"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_next_step", referencedColumnName="step_id")
     * })
     */
    private $actionNextStep;


    /**
     * @var \GestSteps
     *
     * @ORM\ManyToOne(targetEntity="GestSteps"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_from_step", referencedColumnName="step_id")
     * })
     */
    private $actionFromStep;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UpdateForm", mappedBy="updateActionId")
     */
    private $updateField;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestFields", inversedBy="viewAction")
     * @ORM\JoinTable(name="view_form",
     *   joinColumns={
     *     @ORM\JoinColumn(name="view_action_id", referencedColumnName="action_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="view_field_id", referencedColumnName="field_id")
     *   }
     * )
     */
    private $viewField;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updateField = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewField = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new ArrayCollection();
    }

    public function getActionId(): ?int
    {
        return $this->actionId;
    }

    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    public function setActionName(?string $actionName): self
    {
        $this->actionName = $actionName;

        return $this;
    }

    public function getActionBtnName(): ?string
    {
        return $this->actionBtnName;
    }

    public function setActionBtnName(?string $actionBtnName): self
    {
        $this->actionBtnName = $actionBtnName;

        return $this;
    }

    public function getActionType(): ?int
    {
        return $this->actionType;
    }

    public function setActionType(?int $actionType): self
    {
        $this->actionType = $actionType;

        return $this;
    }

    public function getActionStep(): ?int
    {
        return $this->actionStep;
    }

    public function setActionStep(?int $actionStep): self
    {
        $this->actionStep = $actionStep;

        return $this;
    }

    /**
     * @return Collection|GestSteps[]
     */
    public function getStep(): Collection
    {
        return $this->step;
    }

    public function addStep(GestSteps $step): self
    {
        if (!$this->step->contains($step)) {
            $this->step[] = $step;
            $step->addAction($this);
        }

        return $this;
    }

    public function removeStep(GestSteps $step): self
    {
        if ($this->step->contains($step)) {
            $this->step->removeElement($step);
            $step->removeAction($this);
        }

        return $this;
    }
 



    /**
     * @return Collection|GestFields[]
     */
    public function getViewField(): Collection
    {
        return $this->viewField;
    }

    public function addViewField(GestFields $viewField): self
    {
        if (!$this->viewField->contains($viewField)) {
            $this->viewField[] = $viewField;
        }

        return $this;
    }

    public function removeViewField(GestFields $viewField): self
    {
        if ($this->viewField->contains($viewField)) {
            $this->viewField->removeElement($viewField);
        }

        return $this;
    }

    public function getActionEntityName(): ?string
    {
        return $this->actionEntityName;
    }

    public function setActionEntityName(?string $actionEntityName): self
    {
        $this->actionEntityName = $actionEntityName;

        return $this;
    }

    public function getActionProcess(): ?GestProcess
    {
        return $this->actionProcess;
    }

    public function setActionProcess(?GestProcess $actionProcess): self
    {
        $this->actionProcess = $actionProcess;

        return $this;
    }

    public function getActionIsmainLevel(): ?int
    {
        return $this->actionIsmainLevel;
    }

    public function setActionIsmainLevel(?int $actionIsmainLevel): self
    {
        $this->actionIsmainLevel = $actionIsmainLevel;

        return $this;
    }

    public function getActionLevelDepth(): ?int
    {
        return $this->actionLevelDepth;
    }

    public function setActionLevelDepth(?int $actionLevelDepth): self
    {
        $this->actionLevelDepth = $actionLevelDepth;

        return $this;
    }

    public function getActionSubProcess(): ?GestProcess
    {
        return $this->actionSubProcess;
    }

    public function setActionSubProcess(?GestProcess $actionSubProcess): self
    {
        $this->actionSubProcess = $actionSubProcess;

        return $this;
    }

    public function getActionSubEntity(): ?GestEntity
    {
        return $this->actionSubEntity;
    }

    public function setActionSubEntity(?GestEntity $actionSubEntity): self
    {
        $this->actionSubEntity = $actionSubEntity;

        return $this;
    }

    public function getActionEntity(): ?GestEntity
    {
        return $this->actionEntity;
    }

    public function setActionEntity(?GestEntity $actionEntity): self
    {
        $this->actionEntity = $actionEntity;

        return $this;
    }

    public function getActionExistingSubEntity(): ?int
    {
        return $this->actionExistingSubEntity;
    }

    public function setActionExistingSubEntity(?int $actionExistingSubEntity): self
    {
        $this->actionExistingSubEntity = $actionExistingSubEntity;

        return $this;
    }

    /**
     * @return Collection|UpdateForm[]
     */
    public function getUpdateField(): Collection
    {
        return $this->updateField;
    }

    public function addUpdateField(UpdateForm $updateField): self
    {
        if (!$this->updateField->contains($updateField)) {
            $this->updateField[] = $updateField;
            $updateField->setUpdateActionId($this);
        }

        return $this;
    }

    public function removeUpdateField(UpdateForm $updateField): self
    {
        if ($this->updateField->contains($updateField)) {
            $this->updateField->removeElement($updateField);
            // set the owning side to null (unless already changed)
            if ($updateField->getUpdateActionId() === $this) {
                $updateField->setUpdateActionId(null);
            }
        }

        return $this;
    }

    public function getActionNextStep(): ?GestSteps
    {
        return $this->actionNextStep;
    }

    public function setActionNextStep(?GestSteps $actionNextStep): self
    {
        $this->actionNextStep = $actionNextStep;

        return $this;
    }

    public function getActionAddSubEntity(): ?int
    {
        return $this->actionAddSubEntity;
    }

    public function setActionAddSubEntity(?int $actionAddSubEntity): self
    {
        $this->actionAddSubEntity = $actionAddSubEntity;

        return $this;
    }

    public function getActionFromStep(): ?GestSteps
    {
        return $this->actionFromStep;
    }

    public function setActionFromStep(?GestSteps $actionFromStep): self
    {
        $this->actionFromStep = $actionFromStep;

        return $this;
    }

    /**
     * @return Collection|GestRole[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(GestRole $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->addStep($this);
        }

        return $this;
    }

    public function removeRole(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removeStep($this);
        }

        return $this;
    }

}
