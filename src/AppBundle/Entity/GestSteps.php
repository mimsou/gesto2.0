<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestSteps
 *
 * @ORM\Table(name="gest_steps", indexes={@ORM\Index(name="fk_gest_steps_gest_process1_idx", columns={"step_process"})})
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
     * @ORM\ManyToOne(targetEntity="GestProcess",inversedBy="steps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="step_process", referencedColumnName="process_id"  )
     * })
     */
    private $stepProcess;


    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess",inversedBy="fromsteps")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="step_from_process", referencedColumnName="process_id"  )
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
     * @ORM\ManyToMany(targetEntity="GestActions", inversedBy="step" , cascade={"persist"})
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
     * @ORM\ManyToMany(targetEntity="GestList", inversedBy="step" , cascade={"persist"})
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
        $this->$list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list = new ArrayCollection();
    }

    public function getStepId(): ?int
    {
        return $this->stepId;
    }

    public function getStepName(): ?string
    {
        return $this->stepName;
    }

    public function setStepName(?string $stepName): self
    {
        $this->stepName = $stepName;

        return $this;
    }

    public function getStepSequence(): ?int
    {
        return $this->stepSequence;
    }

    public function setStepSequence(?int $stepSequence): self
    {
        $this->stepSequence = $stepSequence;

        return $this;
    }

    public function getStepProcess(): ?GestProcess
    {
        return $this->stepProcess;
    }

    public function setStepProcess(?GestProcess $stepProcess): self
    {
        $this->stepProcess = $stepProcess;

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
     * @return Collection|GestActions[]
     */
    public function getAction(): Collection
    {
        return $this->action;
    }

    public function addAction(GestActions $action): self
    {
        if (!$this->action->contains($action)) {
            $this->action[] = $action;
        }

        return $this;
    }

    public function removeAction(GestActions $action): self
    {
        if ($this->action->contains($action)) {
            $this->action->removeElement($action);
        }

        return $this;
    }

    /**
     * @return Collection|GestList[]
     */
    public function getList(): Collection
    {
        return $this->list;
    }

    public function addList(GestList $list): self
    {
        if (!$this->list->contains($list)) {
            $this->list[] = $list;
        }

        return $this;
    }

    public function removeList(GestList $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
        }

        return $this;
    }

    public function getStepFromProcess(): ?GestProcess
    {
        return $this->stepFromProcess;
    }

    public function setStepFromProcess(?GestProcess $stepFromProcess): self
    {
        $this->stepFromProcess = $stepFromProcess;

        return $this;
    }

}
