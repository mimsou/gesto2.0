<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestActions
 *
 * @ORM\Table(name="gest_actions", indexes={@ORM\Index(name="IDX_A28F1A2B922930C2", columns={"action_from_step"}), @ORM\Index(name="IDX_A28F1A2B5CBF9077", columns={"action_process"}), @ORM\Index(name="IDX_A28F1A2BDFDB61EE", columns={"action_sub_entity"}), @ORM\Index(name="IDX_A28F1A2BD92F5BFB", columns={"action_next_step"}), @ORM\Index(name="IDX_A28F1A2BCC187503", columns={"action_entity"}), @ORM\Index(name="IDX_A28F1A2B8217CDA6", columns={"action_sub_process"})})
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
     * @var string|null
     *
     * @ORM\Column(name="action_print_head", type="text", length=16777215, nullable=true)
     */
    private $actionPrintHead;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_middle", type="text", length=16777215, nullable=true)
     */
    private $actionPrintMiddle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_footer", type="text", length=16777215, nullable=true)
     */
    private $actionPrintFooter;

    /**
     * @var string|null
     *
     * @ORM\Column(name="action_print_page_title", type="text", length=16777215, nullable=true)
     */
    private $actionPrintPageTitle;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_process", referencedColumnName="process_id")
     * })
     */
    private $actionProcess;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_sub_process", referencedColumnName="process_id")
     * })
     */
    private $actionSubProcess;

    /**
     * @var \GestSteps
     *
     * @ORM\ManyToOne(targetEntity="GestSteps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_from_step", referencedColumnName="step_id")
     * })
     */
    private $actionFromStep;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_entity", referencedColumnName="entity_id")
     * })
     */
    private $actionEntity;

    /**
     * @var \GestSteps
     *
     * @ORM\ManyToOne(targetEntity="GestSteps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_next_step", referencedColumnName="step_id")
     * })
     */
    private $actionNextStep;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="action_sub_entity", referencedColumnName="entity_id")
     * })
     */
    private $actionSubEntity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="action")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", mappedBy="action")
     */
    private $step;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestFields", inversedBy="updateAction")
     * @ORM\JoinTable(name="update_form",
     *   joinColumns={
     *     @ORM\JoinColumn(name="update_action_id", referencedColumnName="action_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="update_field_id", referencedColumnName="field_id")
     *   }
     * )
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
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updateField = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewField = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
