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
     * Constructor
     */
    public function __construct()
    {
        $this->field = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->step = new ArrayCollection();
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

}
