<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestEntity
 *
 * @ORM\Table(name="gest_entity")
 * @ORM\Entity
 */
class GestEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="entity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $entityId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_table", type="string", length=150, nullable=true)
     */
    private $entityTable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_display_field", type="string", length=150, nullable=true)
     */
    private $entityDisplayfield;


    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_stepper_field", type="string", length=150, nullable=true)
     */
    private $entityStepperField;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_entity", type="string", length=150, nullable=true)
     */
    private $entityEntity;


    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_interface_name", type="string", length=200, nullable=true)
     */
    private $entityInterfaceName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_key", type="string", length=300, nullable=true)
     */
    private $entityKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_type", type="string", length=150, nullable=true)
     */
    private $entityType;


    /**
     * @var string|null
     *
     * @ORM\Column(name="entity_pos", type="string", length=150, nullable=true)
     */
    private $entityPos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="entity_fields", type="integer", nullable=true)
     */
    private $entityFields;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="gestEntity")
     */
    private $gestProcess;



    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="gestEntityDimention")
     */
    private $gestProcessDimention;


    /**
 * @var \Doctrine\Common\Collections\Collection
 *
 * @ORM\OneToMany(targetEntity="GestRelations", mappedBy="relationEntitie" , cascade={"persist"})
 */

    private $relations;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestFields", mappedBy="fieldEntity" , cascade={"persist"})
     */

    private $fields;

    /**
 * @var \Doctrine\Common\Collections\Collection
 *
 * @ORM\OneToMany(targetEntity="GestFields", mappedBy="fieldTargetEntityId" , cascade={"persist"})
 */
    private $fieldsInversedTarget;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="GestFields", mappedBy="daEntity" , cascade={"persist"})
     */
    private $daAccessData;


    /**
     * @var int|null
     *
     * @ORM\Column(name="checks", type="integer", nullable=true)
     */
    private $checks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gestProcess = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestProcessDimention = new \Doctrine\Common\Collections\ArrayCollection();
        $this->relations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fieldsInversedTarget = new ArrayCollection();
        $this->daAccessData = new ArrayCollection();
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function getEntityTable(): ?string
    {
        return $this->entityTable;
    }

    public function setEntityTable(?string $entityTable): self
    {
        $this->entityTable = $entityTable;

        return $this;
    }

    public function getEntityEntity(): ?string
    {
        return $this->entityEntity;
    }

    public function setEntityEntity(?string $entityEntity): self
    {
        $this->entityEntity = $entityEntity;

        return $this;
    }

    public function getEntityKey(): ?string
    {
        return $this->entityKey;
    }

    public function setEntityKey(?string $entityKey): self
    {
        $this->entityKey = $entityKey;

        return $this;
    }

    public function getEntityType(): ?string
    {
        return $this->entityType;
    }

    public function setEntityType(?string $entityType): self
    {
        $this->entityType = $entityType;

        return $this;
    }

    public function getEntityFields(): ?int
    {
        return $this->entityFields;
    }

    public function setEntityFields(?int $entityFields): self
    {
        $this->entityFields = $entityFields;

        return $this;
    }

    /**
     * @return Collection|GestProcess[]
     */
    public function getGestProcess(): Collection
    {
        return $this->gestProcess;
    }

    public function addGestProcess(GestProcess $gestProcess): self
    {
        if (!$this->gestProcess->contains($gestProcess)) {
            $this->gestProcess[] = $gestProcess;
            $gestProcess->addGestEntity($this);
        }

        return $this;
    }

    public function removeGestProcess(GestProcess $gestProcess): self
    {
        if ($this->gestProcess->contains($gestProcess)) {
            $this->gestProcess->removeElement($gestProcess);
            $gestProcess->removeGestEntity($this);
        }

        return $this;
    }

    /**
     * @return Collection|GestRelations[]
     */
    public function getRelations(): Collection
    {
        return $this->relations;
    }

    public function addRelation(GestRelations $relation): self
    {
        if (!$this->relations->contains($relation)) {
            $this->relations[] = $relation;
            $relation->setRelationEntitie($this);
        }

        return $this;
    }

    public function removeRelation(GestRelations $relation): self
    {
        if ($this->relations->contains($relation)) {
            $this->relations->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getRelationEntitie() === $this) {
                $relation->setRelationEntitie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GestFields[]
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(GestFields $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields[] = $field;
            $field->setFieldEntity($this);
        }

        return $this;
    }

    public function removeField(GestFields $field): self
    {
        if ($this->fields->contains($field)) {
            $this->fields->removeElement($field);
            // set the owning side to null (unless already changed)
            if ($field->getFieldEntity() === $this) {
                $field->setFieldEntity(null);
            }
        }

        return $this;
    }

    public function getEntityPos(): ?string
    {
        return $this->entityPos;
    }

    public function setEntityPos(?string $entityPos): self
    {
        $this->entityPos = $entityPos;

        return $this;
    }

    /**
     * @return Collection|GestProcess[]
     */
    public function getGestProcessDimention(): Collection
    {
        return $this->gestProcessDimention;
    }

    public function addGestProcessDimention(GestProcess $gestProcessDimention): self
    {
        if (!$this->gestProcessDimention->contains($gestProcessDimention)) {
            $this->gestProcessDimention[] = $gestProcessDimention;
            $gestProcessDimention->addGestEntityDimention($this);
        }

        return $this;
    }

    public function removeGestProcessDimention(GestProcess $gestProcessDimention): self
    {
        if ($this->gestProcessDimention->contains($gestProcessDimention)) {
            $this->gestProcessDimention->removeElement($gestProcessDimention);
            $gestProcessDimention->removeGestEntityDimention($this);
        }

        return $this;
    }

    public function getEntityInterfaceName(): ?string
    {
        return $this->entityInterfaceName;
    }

    public function setEntityInterfaceName(?string $entityInterfaceName): self
    {
        $this->entityInterfaceName = $entityInterfaceName;

        return $this;
    }

    public function getEntityDisplayfield(): ?string
    {
        return $this->entityDisplayfield;
    }

    public function setEntityDisplayfield(?string $entityDisplayfield): self
    {
        $this->entityDisplayfield = $entityDisplayfield;

        return $this;
    }

    /**
     * @return Collection|GestFields[]
     */
    public function getFieldsInversedTarget(): Collection
    {
        return $this->fieldsInversedTarget;
    }

    public function addFieldsInversedTarget(GestFields $fieldsInversedTarget): self
    {
        if (!$this->fieldsInversedTarget->contains($fieldsInversedTarget)) {
            $this->fieldsInversedTarget[] = $fieldsInversedTarget;
            $fieldsInversedTarget->setFieldTargetEntityId($this);
        }

        return $this;
    }

    public function removeFieldsInversedTarget(GestFields $fieldsInversedTarget): self
    {
        if ($this->fieldsInversedTarget->contains($fieldsInversedTarget)) {
            $this->fieldsInversedTarget->removeElement($fieldsInversedTarget);
            // set the owning side to null (unless already changed)
            if ($fieldsInversedTarget->getFieldTargetEntityId() === $this) {
                $fieldsInversedTarget->setFieldTargetEntityId(null);
            }
        }

        return $this;
    }

    public function getEntityStepperField(): ?string
    {
        return $this->entityStepperField;
    }

    public function setEntityStepperField(?string $entityStepperField): self
    {
        $this->entityStepperField = $entityStepperField;

        return $this;
    }

    public function getChecks(): ?int
    {
        return $this->checks;
    }

    public function setChecks(?int $checks): self
    {
        $this->checks = $checks;

        return $this;
    }

    /**
     * @return Collection|GestFields[]
     */
    public function getDaAccessData(): Collection
    {
        return $this->daAccessData;
    }

    public function addDaAccessData(GestFields $daAccessData): self
    {
        if (!$this->daAccessData->contains($daAccessData)) {
            $this->daAccessData[] = $daAccessData;
            $daAccessData->setDaEntity($this);
        }

        return $this;
    }

    public function removeDaAccessData(GestFields $daAccessData): self
    {
        if ($this->daAccessData->contains($daAccessData)) {
            $this->daAccessData->removeElement($daAccessData);
            // set the owning side to null (unless already changed)
            if ($daAccessData->getDaEntity() === $this) {
                $daAccessData->setDaEntity(null);
            }
        }

        return $this;
    }



}
