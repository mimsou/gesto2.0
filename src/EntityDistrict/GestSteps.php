<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestSteps
 *
 * @ORM\Table(name="gest_steps", indexes={@ORM\Index(name="IDX_F36596923B2C0CEB", columns={"step_from_process"}), @ORM\Index(name="fk_gest_steps_gest_process1_idx", columns={"step_process"})})
 * @ORM\Entity
 */
class GestSteps
{
    /**
     * @var int
     *
     * @ORM\Column(name="step_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $stepId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="step_name", type="string", length=150, nullable=true)
     */
    private $stepName;

    /**
     * @var int|null
     *
     * @ORM\Column(name="step_sequence", type="integer", nullable=true)
     */
    private $stepSequence;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="step_process", referencedColumnName="process_id")
     * })
     */
    private $stepProcess;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="step_from_process", referencedColumnName="process_id")
     * })
     */
    private $stepFromProcess;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="step")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", inversedBy="step")
     * @ORM\JoinTable(name="steps_has_actions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="step_id", referencedColumnName="step_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="action_id", referencedColumnName="action_id")
     *   }
     * )
     */
    private $action;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestList", inversedBy="step")
     * @ORM\JoinTable(name="steps_has_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="step_id", referencedColumnName="step_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="list_id", referencedColumnName="list_id")
     *   }
     * )
     */
    private $list;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->action = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
