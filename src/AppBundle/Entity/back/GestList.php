<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestList
 *
 * @ORM\Table(name="gest_list", indexes={@ORM\Index(name="fk_gest_list_gest_process1_idx", columns={"list_process"})})
 * @ORM\Entity
 */
class GestList
{
    /**
     * @var int
     *
     * @ORM\Column(name="list_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $listId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="list_name", type="string", length=150, nullable=true)
     */
    private $listName;


    /**
     * @var string|null
     *
     * @ORM\Column(name="list_regle", type="string", length=2000, nullable=true)
     */
    private $listRegle;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="list_is_main", type="integer" , nullable=true)
     */
    private $listIsMain;


    /**
     * @var string|null
     *
     * @ORM\Column(name="list_entity_name", type="integer", nullable=true)
     */
    private $listEntityName;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="list_process", referencedColumnName="process_id")
     * })
     */
    private $listProcess;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestFields", inversedBy="list")
     * @ORM\JoinTable(name="list_has_fields",
     *   joinColumns={
     *     @ORM\JoinColumn(name="list_id", referencedColumnName="list_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="field_id", referencedColumnName="field_id")
     *   }
     * )
     */
    private $field;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", mappedBy="list" , cascade={"persist"})
     */
    private $step;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="list")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestListRegle", mappedBy="regList")
     */
     private $listReg;

    /**
     * @var integer|null
     *
     * @ORM\Column(name="list_type", type="integer" , nullable=true)
     */
    private $listType;

    /**
     * @var boolean|null
     *
     * @ORM\Column(name="list_is_linked", type="boolean" , nullable=true  )
     */
    private $listIsLinked;


    /**
     * @var string|null
     *
     * @ORM\Column(name="list_report_config", type="string", nullable=true , length=50000)
     */
    private $listReportConfig;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->field = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->step = new ArrayCollection();
        $this->listReg = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getListId(): ?int
    {
        return $this->listId;
    }

    public function getListName(): ?string
    {
        return $this->listName;
    }

    public function setListName(?string $listName): self
    {
        $this->listName = $listName;

        return $this;
    }

    public function getListProcess(): ?GestProcess
    {
        return $this->listProcess;
    }

    public function setListProcess(?GestProcess $listProcess): self
    {
        $this->listProcess = $listProcess;

        return $this;
    }

    /**
     * @return Collection|GestFields[]
     */
    public function getField(): Collection
    {
        return $this->field;
    }

    public function addField(GestFields $field): self
    {
        if (!$this->field->contains($field)) {
            $this->field[] = $field;
        }

        return $this;
    }

    public function removeField(GestFields $field): self
    {
        if ($this->field->contains($field)) {
            $this->field->removeElement($field);
        }

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
            $role->addList($this);
        }

        return $this;
    }

    public function removeRole(GestRole $role): self
    {
        if ($this->role->contains($role)) {
            $this->role->removeElement($role);
            $role->removeList($this);
        }

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
            $step->addList($this);
        }

        return $this;
    }

    public function removeStep(GestSteps $step): self
    {
        if ($this->step->contains($step)) {
            $this->step->removeElement($step);
            $step->removeList($this);
        }

        return $this;
    }

    public function getListEntityName()
    {
        return $this->listEntityName;
    }

    public function setListEntityName($listEntityName): self
    {
        $this->listEntityName = $listEntityName;

        return $this;
    }

    public function getListIsMain(): ?int
    {
        return $this->listIsMain;
    }

    public function setListIsMain(?int $listIsMain): self
    {
        $this->listIsMain = $listIsMain;

        return $this;
    }

    public function getListRegle(): ?string
    {
        return $this->listRegle;
    }

    public function setListRegle(?string $listRegle): self
    {
        $this->listRegle = $listRegle;

        return $this;
    }

    /**
     * @return Collection|GestListRegle[]
     */
    public function getListReg(): Collection
    {
        return $this->listReg;
    }

    public function addListReg(GestListRegle $listReg): self
    {
        if (!$this->listReg->contains($listReg)) {
            $this->listReg[] = $listReg;
            $listReg->setRegList($this);
        }

        return $this;
    }

    public function removeListReg(GestListRegle $listReg): self
    {
        if ($this->listReg->contains($listReg)) {
            $this->listReg->removeElement($listReg);
            // set the owning side to null (unless already changed)
            if ($listReg->getRegList() === $this) {
                $listReg->setRegList(null);
            }
        }

        return $this;
    }

    public function getListType(): ?int
    {
        return $this->listType;
    }

    public function setListType(?int $listType): self
    {
        $this->listType = $listType;

        return $this;
    }

    public function getListReportConfig(): ?string
    {
        return $this->listReportConfig;
    }

    public function setListReportConfig(?string $listReportConfig): self
    {
        $this->listReportConfig = $listReportConfig;

        return $this;
    }

    public function getListIsLinked(): ?bool
    {
        return $this->listIsLinked;
    }

    public function setListIsLinked(bool $listIsLinked): self
    {
        $this->listIsLinked = $listIsLinked;

        return $this;
    }

}
