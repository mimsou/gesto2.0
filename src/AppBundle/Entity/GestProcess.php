<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestProcess
 *
 * @ORM\Table(name="gest_process")
 * @ORM\Entity
 */
class GestProcess
{
    /**
     * @var int
     *
     * @ORM\Column(name="process_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $processId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="process_designation", type="string", length=150, nullable=true)
     */
    private $processDesignation;



    /**
     * @var string|null
     *
     * @ORM\Column(name="process_requiredim", type="string", length=150, nullable=true)
     */
    private $processRequiredim;



    /**
     * @var string|null
     *
     * @ORM\Column(name="process_menu_title", type="string", length=150, nullable=true)
     */
    private $processMenuTitle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestEntity", inversedBy="gestProcess")
     * @ORM\JoinTable(name="process_has_entity",
     *   joinColumns={
     *     @ORM\JoinColumn(name="gest_process_id", referencedColumnName="process_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="gest_entity_id", referencedColumnName="entity_id")
     *   }
     * )
     */
    private $gestEntity;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestEntity", inversedBy="gestProcessDimention")
     * @ORM\JoinTable(name="process_has_dimention" ,
     *   joinColumns={
     *     @ORM\JoinColumn(name="process_id", referencedColumnName="process_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="entity_id", referencedColumnName="entity_id")
     *   }
     * )
     */
    private $gestEntityDimention;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     *
     * @ORM\ManyToMany(targetEntity="GestFields", inversedBy="gestProcessDimention")
     * @ORM\JoinTable(name="process_has_fielddimention" ,
     *   joinColumns={
     *     @ORM\JoinColumn(name="process_id", referencedColumnName="process_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="field_id", referencedColumnName="field_id")
     *   }
     * )
     */

    private $gestFieldDimention;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestSteps", mappedBy="stepProcess" , cascade={"persist"})
     */

    private $steps;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestSteps", mappedBy="stepFromProcess" , cascade={"persist"})
     */

    private $fromsteps;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestActions", mappedBy="actionProcess" , cascade={"persist"})
     */

     private  $actions;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestList", mappedBy="listProcess" , cascade={"persist"})
     */

    private $list;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gestEntity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestEntityDimention = new \Doctrine\Common\Collections\ArrayCollection();
        $this->steps = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestFieldDimention = new ArrayCollection();
        $this->fromsteps = new ArrayCollection();
    }

    public function getProcessId(): ?int
    {
        return $this->processId;
    }

    public function getProcessDesignation(): ?string
    {
        return $this->processDesignation;
    }

    public function setProcessDesignation(?string $processDesignation): self
    {
        $this->processDesignation = $processDesignation;

        return $this;
    }

    public function getProcessMenuTitle(): ?string
    {
        return $this->processMenuTitle;
    }

    public function setProcessMenuTitle(?string $processMenuTitle): self
    {
        $this->processMenuTitle = $processMenuTitle;

        return $this;
    }

    /**
     * @return Collection|GestEntity[]
     */
    public function getGestEntity(): Collection
    {
        return $this->gestEntity;
    }

    public function addGestEntity(GestEntity $gestEntity): self
    {
        if (!$this->gestEntity->contains($gestEntity)) {
            $this->gestEntity[] = $gestEntity;
        }

        return $this;
    }

    public function removeGestEntity(GestEntity $gestEntity): self
    {
        if ($this->gestEntity->contains($gestEntity)) {
            $this->gestEntity->removeElement($gestEntity);
        }

        return $this;
    }

    /**
     * @return Collection|GestSteps[]
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(GestSteps $step): self
    {
        if (!$this->steps->contains($step)) {
            $this->steps[] = $step;
            $step->setStepProcess($this);
        }

        return $this;
    }

    public function removeStep(GestSteps $step): self
    {
        if ($this->steps->contains($step)) {
            $this->steps->removeElement($step);
            // set the owning side to null (unless already changed)
            if ($step->getStepProcess() === $this) {
                $step->setStepProcess(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestActions[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(GestActions $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setActionProcess($this);
        }

        return $this;
    }

    public function removeAction(GestActions $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getActionProcess() === $this) {
                $action->setActionProcess(null);
            }
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
            $list->setListProcess($this);
        }

        return $this;
    }

    public function removeList(GestList $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
            // set the owning side to null (unless already changed)
            if ($list->getListProcess() === $this) {
                $list->setListProcess(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestEntity[]
     */
    public function getGestEntityDimention(): Collection
    {
        return $this->gestEntityDimention;
    }

    public function addGestEntityDimention(GestEntity $gestEntityDimention): self
    {
        if (!$this->gestEntityDimention->contains($gestEntityDimention)) {
            $this->gestEntityDimention[] = $gestEntityDimention;
        }

        return $this;
    }

    public function removeGestEntityDimention(GestEntity $gestEntityDimention): self
    {
        if ($this->gestEntityDimention->contains($gestEntityDimention)) {
            $this->gestEntityDimention->removeElement($gestEntityDimention);
        }

        return $this;
    }

    /**
     * @return Collection|GestFields[]
     */
    public function getGestFieldDimention(): Collection
    {
        return $this->gestFieldDimention;
    }

    public function addGestFieldDimention(GestFields $gestFieldDimention): self
    {
        if (!$this->gestFieldDimention->contains($gestFieldDimention)) {
            $this->gestFieldDimention[] = $gestFieldDimention;
        }

        return $this;
    }

    public function removeGestFieldDimention(GestFields $gestFieldDimention): self
    {
        if ($this->gestFieldDimention->contains($gestFieldDimention)) {
            $this->gestFieldDimention->removeElement($gestFieldDimention);
        }

        return $this;
    }

    /**
     * @return Collection|GestSteps[]
     */
    public function getFromsteps(): Collection
    {
        return $this->fromsteps;
    }

    public function addFromstep(GestSteps $fromstep): self
    {
        if (!$this->fromsteps->contains($fromstep)) {
            $this->fromsteps[] = $fromstep;
            $fromstep->setStepFromProcess($this);
        }

        return $this;
    }

    public function removeFromstep(GestSteps $fromstep): self
    {
        if ($this->fromsteps->contains($fromstep)) {
            $this->fromsteps->removeElement($fromstep);
            // set the owning side to null (unless already changed)
            if ($fromstep->getStepFromProcess() === $this) {
                $fromstep->setStepFromProcess(null);
            }
        }

        return $this;
    }

    public function getProcessRequiredim(): ?string
    {
        return $this->processRequiredim;
    }

    public function setProcessRequiredim(?string $processRequiredim): self
    {
        $this->processRequiredim = $processRequiredim;

        return $this;
    }



}
