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
     * @var int|null
     *
     * @ORM\Column(name="action_affectation", type="integer", length=2, nullable=true)
     */
    private $actionAffectation; 


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestActions", mappedBy="actionSubActions" , cascade={"persist"})
     */

    private  $actionParent;



    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestActions",inversedBy="actionParent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_sub_action", referencedColumnName="action_id"  )
     * })
     */
    private  $actionSubActions;

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
     * @ORM\Column(name="action_dissociate_sub_entity", type="integer", nullable=true)
     */
    private $actionDissociateSubEntity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_dissociate_subbtn_name", type="string", length=500, nullable=true)
     */
    private $actionDissociateSubbtnName;


    /**
     * @var int|null
     *
     * @ORM\Column(name="action_level_depth", type="integer", nullable=true)
     */
    private $actionLevelDepth;


    /**
     * @var int|null
     *
     * @ORM\Column(name="action_delete_sub_entity", type="integer", nullable=true)
     */
    private $actionDeleteSubEntity;



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
     * 
     */

    private $actionNextStep;


    /**
     * @var \GestSteps
     *
     * @ORM\ManyToOne(targetEntity="GestSteps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_subentity_next_step_ondissociation", referencedColumnName="step_id")
     * })
     */

    private $actionSubentityNextStepOndissociation;


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
     * @ORM\OneToMany(targetEntity="GestActionsRegle", mappedBy="acregAction")
     */
    private $actionAcreg;



    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestCustomCode", mappedBy="customCodeAction")
     */
    private $actionCustomCode;

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
     * @var string|null
     *
     * @ORM\Column(name="action_print_page_title", type="string", length=50000, nullable=true)
     */
    private $actionPrintPageTitle;


    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_head", type="string", length=50000, nullable=true)
     */
    private $actionPrintHead;


    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_middle", type="string", length=50000, nullable=true)
     */
    private $actionPrintMiddle;



    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_footer", type="string", length=50000, nullable=true)
     */
    private $actionPrintFooter;



     /**
     * @var string|null
     *
     * @ORM\Column(name="action_inner_custom_code_befor_main_persist", type="string", length=10000000, nullable=true)
     */
    private $actionInnerCustomCodeBeforMainPersist;


     /**
     * @var string|null
     *
     * @ORM\Column(name="action_inner_custom_code_after_main_persist", type="string", length=10000000, nullable=true)
     */
    private $actionInnerCustomCodeAfterMainPersist;


      /**
     * @var string|null
     *
     * @ORM\Column(name="action_inner_custom_code_befor_sub_persist", type="string", length=10000000, nullable=true)
     */
    private $actionInnerCustomCodeBeforSubPersist;


    
      /**
     * @var string|null
     *
     * @ORM\Column(name="action_inner_custom_code_after_sub_persist", type="string", length=10000000, nullable=true)
     */
    private $actionInnerCustomCodeAfterSubPersist;


    
    /**
     * @var string|null
     *
     * @ORM\Column(name="action_inner_custom_code", type="string", length=10000000, nullable=true)
     */
    private $actionInnerCustomCode;


       /**
     * @var string|null
     *
     * @ORM\Column(name="action_sub_check_custom_code", type="string", length=10000000, nullable=true)
     */
    private $actionSubCheckCustomCode;

     


     /**
     * @var int|null
     *
     * @ORM\Column(name="action_custom_code_mode", type="integer", length=2, nullable=true)
     */
    private $actionCustomCodeMode;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updateField = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewField = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new ArrayCollection();
        $this->actionAcreg = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actionCustomCode = new ArrayCollection();
        $this->actionParent = new ArrayCollection();
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

    /**
     * @return Collection|GestActionsRegle[]
     */
    public function getActionAcreg(): Collection
    {
        return $this->actionAcreg;
    }

    public function addActionAcreg(GestActionsRegle $actionAcreg): self
    {
        if (!$this->actionAcreg->contains($actionAcreg)) {
            $this->actionAcreg[] = $actionAcreg;
            $actionAcreg->setAcregAction($this);
        }

        return $this;
    }

    public function removeActionAcreg(GestActionsRegle $actionAcreg): self
    {
        if ($this->actionAcreg->contains($actionAcreg)) {
            $this->actionAcreg->removeElement($actionAcreg);
            // set the owning side to null (unless already changed)
            if ($actionAcreg->getAcregAction() === $this) {
                $actionAcreg->setAcregAction(null);
            }
        }

        return $this;
    }

    public function getActionPrintHead(): ?string
    {
        return $this->actionPrintHead;
    }

    public function setActionPrintHead(?string $actionPrintHead): self
    {
        $this->actionPrintHead = $actionPrintHead;

        return $this;
    }

    public function getActionPrintMiddle(): ?string
    {
        return $this->actionPrintMiddle;
    }

    public function setActionPrintMiddle(?string $actionPrintMiddle): self
    {
        $this->actionPrintMiddle = $actionPrintMiddle;

        return $this;
    }

    public function getActionPrintFooter(): ?string
    {
        return $this->actionPrintFooter;
    }

    public function setActionPrintFooter(?string $actionPrintFooter): self
    {
        $this->actionPrintFooter = $actionPrintFooter;

        return $this;
    }

    public function getActionPrintPageTitle(): ?string
    {
        return $this->actionPrintPageTitle;
    }

    public function setActionPrintPageTitle(?string $actionPrintPageTitle): self
    {
        $this->actionPrintPageTitle = $actionPrintPageTitle;

        return $this;
    }

    public function getActionDissociateSubEntity(): ?int
    {
        return $this->actionDissociateSubEntity;
    }

    public function setActionDissociateSubEntity(?int $actionDissociateSubEntity): self
    {
        $this->actionDissociateSubEntity = $actionDissociateSubEntity;

        return $this;
    }

    public function getActionDissociateSubbtnName(): ?string
    {
        return $this->actionDissociateSubbtnName;
    }

    public function setActionDissociateSubbtnName(?string $actionDissociateSubbtnName): self
    {
        $this->actionDissociateSubbtnName = $actionDissociateSubbtnName;

        return $this;
    }

    public function getActionSubentityNextStepOndissociation(): ?GestSteps
    {
        return $this->actionSubentityNextStepOndissociation;
    }

    public function setActionSubentityNextStepOndissociation(?GestSteps $actionSubentityNextStepOndissociation): self
    {
        $this->actionSubentityNextStepOndissociation = $actionSubentityNextStepOndissociation;

        return $this;
    }

    public function getActionCustomCode(): ?string
    {
        return $this->actionCustomCode;
    }

    public function setActionCustomCode(?string $actionCustomCode): self
    {
        $this->actionCustomCode = $actionCustomCode;

        return $this;
    }

    public function getActionCustomCodeMode(): ?int
    {
        return $this->actionCustomCodeMode;
    }

    public function setActionCustomCodeMode(?int $actionCustomCodeMode): self
    {
        $this->actionCustomCodeMode = $actionCustomCodeMode;

        return $this;
    }

    public function addActionCustomCode(GestCustomCode $actionCustomCode): self
    {
        if (!$this->actionCustomCode->contains($actionCustomCode)) {
            $this->actionCustomCode[] = $actionCustomCode;
            $actionCustomCode->setCustomCodeAction($this);
        }

        return $this;
    }

    public function removeActionCustomCode(GestCustomCode $actionCustomCode): self
    {
        if ($this->actionCustomCode->contains($actionCustomCode)) {
            $this->actionCustomCode->removeElement($actionCustomCode);
            // set the owning side to null (unless already changed)
            if ($actionCustomCode->getCustomCodeAction() === $this) {
                $actionCustomCode->setCustomCodeAction(null);
            }
        }

        return $this;
    }

    public function getActionInnerCustomCode(): ?string
    {
        return $this->actionInnerCustomCode;
    }

    public function setActionInnerCustomCode(?string $actionInnerCustomCode): self
    {
        $this->actionInnerCustomCode = $actionInnerCustomCode;

        return $this;
    }

    public function getActionInnerCustomCodeBeforMainPersist(): ?string
    {
        return $this->actionInnerCustomCodeBeforMainPersist;
    }

    public function setActionInnerCustomCodeBeforMainPersist(?string $actionInnerCustomCodeBeforMainPersist): self
    {
        $this->actionInnerCustomCodeBeforMainPersist = $actionInnerCustomCodeBeforMainPersist;

        return $this;
    }

    public function getActionInnerCustomCodeAfterMainPersist(): ?string
    {
        return $this->actionInnerCustomCodeAfterMainPersist;
    }

    public function setActionInnerCustomCodeAfterMainPersist(?string $actionInnerCustomCodeAfterMainPersist): self
    {
        $this->actionInnerCustomCodeAfterMainPersist = $actionInnerCustomCodeAfterMainPersist;

        return $this;
    }

    public function getActionInnerCustomCodeBeforSubPersist(): ?string
    {
        return $this->actionInnerCustomCodeBeforSubPersist;
    }

    public function setActionInnerCustomCodeBeforSubPersist(?string $actionInnerCustomCodeBeforSubPersist): self
    {
        $this->actionInnerCustomCodeBeforSubPersist = $actionInnerCustomCodeBeforSubPersist;

        return $this;
    }

    public function getActionInnerCustomCodeAfterSubPersist(): ?string
    {
        return $this->actionInnerCustomCodeAfterSubPersist;
    }

    public function setActionInnerCustomCodeAfterSubPersist(?string $actionInnerCustomCodeAfterSubPersist): self
    {
        $this->actionInnerCustomCodeAfterSubPersist = $actionInnerCustomCodeAfterSubPersist;

        return $this;
    }

    public function getActionSubCheckCustomCode(): ?string
    {
        return $this->actionSubCheckCustomCode;
    }

    public function setActionSubCheckCustomCode(?string $actionSubCheckCustomCode): self
    {
        $this->actionSubCheckCustomCode = $actionSubCheckCustomCode;

        return $this;
    }

    public function getActionAffectation(): ?int
    {
        return $this->actionAffectation;
    }

    public function setActionAffectation(?int $actionAffectation): self
    {
        $this->actionAffectation = $actionAffectation;

        return $this;
    }

    /**
     * @return Collection|GestActions[]
     */
    public function getActionParent(): Collection
    {
        return $this->actionParent;
    }

    public function addActionParent(GestActions $actionParent): self
    {
        if (!$this->actionParent->contains($actionParent)) {
            $this->actionParent[] = $actionParent;
            $actionParent->setActionSubActions($this);
        }

        return $this;
    }

    public function removeActionParent(GestActions $actionParent): self
    {
        if ($this->actionParent->contains($actionParent)) {
            $this->actionParent->removeElement($actionParent);
            // set the owning side to null (unless already changed)
            if ($actionParent->getActionSubActions() === $this) {
                $actionParent->setActionSubActions(null);
            }
        }

        return $this;
    }

    public function getActionSubActions(): ?self
    {
        return $this->actionSubActions;
    }

    public function setActionSubActions(?self $actionSubActions): self
    {
        $this->actionSubActions = $actionSubActions;

        return $this;
    }

    public function getActionDeleteSubEntity(): ?int
    {
        return $this->actionDeleteSubEntity;
    }

    public function setActionDeleteSubEntity(?int $actionDeleteSubEntity): self
    {
        $this->actionDeleteSubEntity = $actionDeleteSubEntity;

        return $this;
    }

}
