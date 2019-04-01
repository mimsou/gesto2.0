<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestFields
 *
 * @ORM\Table(name="gest_fields", indexes={@ORM\Index(name="fk_gest_fields_gest_entity1_idx", columns={"field_entity"})})
 * @ORM\Entity
 */
class GestFields
{
    /**
     * @var int
     *
     * @ORM\Column(name="field_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fieldId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_entity_name", type="string", length=150, nullable=true)
     */
    private $fieldEntityName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_column_name", type="string", length=150, nullable=true)
     */
    private $fieldColumnName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_interface_name", type="string", length=200, nullable=true)
     */
    private $fieldInterfaceName;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="gestFieldDimention")
     */
    private $gestProcessDimention;


    /**
     * @var string|null
     *
     * @ORM\Column(name="field_type", type="string", length=150, nullable=true)
     */
    private $fieldType;



    /**
     * @var string|null
     *
     * @ORM\Column(name="field_expression", type="string", length=2000, nullable=true)
     */
    private $fieldExpression;


    /**
     * @var string|null
     *
     * @ORM\Column(name="field_target_entity", type="string", length=150, nullable=true)
     */
    private $fieldTargetEntity;


    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" ,inversedBy="fieldsInversedTarget"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_target_entity_id", referencedColumnName="entity_id")
     * })
     */
    private $fieldTargetEntityId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_nature", type="integer",  nullable=true)
     */
    private $fieldNature;


    /**
     * @var string|null
     *
     * @ORM\Column(name="field_is_dimention", type="integer",   nullable=true)
     */
    private $fieldIsDimention;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_length", type="string", length=150, nullable=true)
     */
    private $fieldLength;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" ,inversedBy="fields"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_entity", referencedColumnName="entity_id")
     * })
     */
    private $fieldEntity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestList", mappedBy="field")
     */
    private $list;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="UpdateForm", mappedBy="updateFieldId")
     */
    private $updateAction;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", mappedBy="viewField")
     */
    private $viewAction;


    /**
     * @var int|null
     *
     * @ORM\Column(name="field_order", type="integer", nullable=true)
     */
    private $fieldOrder;

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
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updateAction = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewAction = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestProcessDiemntion = new ArrayCollection();

    }

    public function getFieldId(): ?int
    {
        return $this->fieldId;
    }

    public function getFieldEntityName(): ?string
    {
        return $this->fieldEntityName;
    }

    public function setFieldEntityName(?string $fieldEntityName): self
    {
        $this->fieldEntityName = $fieldEntityName;

        return $this;
    }

    public function getFieldColumnName(): ?string
    {
        return $this->fieldColumnName;
    }

    public function setFieldColumnName(?string $fieldColumnName): self
    {
        $this->fieldColumnName = $fieldColumnName;

        return $this;
    }

    public function getFieldType(): ?string
    {
        return $this->fieldType;
    }

    public function setFieldType(?string $fieldType): self
    {
        $this->fieldType = $fieldType;

        return $this;
    }

    public function getFieldLength(): ?string
    {
        return $this->fieldLength;
    }

    public function setFieldLength(?string $fieldLength): self
    {
        $this->fieldLength = $fieldLength;

        return $this;
    }

    public function getFieldEntity(): ?GestEntity
    {
        return $this->fieldEntity;
    }

    public function setFieldEntity(?GestEntity $fieldEntity): self
    {
        $this->fieldEntity = $fieldEntity;

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
            $list->addField($this);
        }

        return $this;
    }

    public function removeList(GestList $list): self
    {
        if ($this->list->contains($list)) {
            $this->list->removeElement($list);
            $list->removeField($this);
        }

        return $this;
    }


    /**
     * @return Collection|GestActions[]
     */
    public function getViewAction(): Collection
    {
        return $this->viewAction;
    }

    public function addViewAction(GestActions $viewAction): self
    {
        if (!$this->viewAction->contains($viewAction)) {
            $this->viewAction[] = $viewAction;
            $viewAction->addViewField($this);
        }

        return $this;
    }

    public function removeViewAction(GestActions $viewAction): self
    {
        if ($this->viewAction->contains($viewAction)) {
            $this->viewAction->removeElement($viewAction);
            $viewAction->removeViewField($this);
        }

        return $this;
    }

    public function getFieldNature()
    {
        return $this->fieldNature;
    }

    public function setFieldNature($fieldNature): self
    {
        $this->fieldNature = $fieldNature;

        return $this;
    }

    public function getFieldIsDimention()
    {
        return $this->fieldIsDimention;
    }

    public function setFieldIsDimention($fieldIsDimention): self
    {
        $this->fieldIsDimention = $fieldIsDimention;

        return $this;
    }

    public function getFieldInterfaceName(): ?string
    {
        return $this->fieldInterfaceName;
    }

    public function setFieldInterfaceName(?string $fieldInterfaceName): self
    {
        $this->fieldInterfaceName = $fieldInterfaceName;

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
            $gestProcessDimention->addGestFieldDimention($this);
        }

        return $this;
    }

    public function removeGestProcessDimention(GestProcess $gestProcessDimention): self
    {
        if ($this->gestProcessDimention->contains($gestProcessDimention)) {
            $this->gestProcessDimention->removeElement($gestProcessDimention);
            $gestProcessDimention->removeGestFieldDimention($this);
        }

        return $this;
    }

    /**
     * @return Collection|UpdateForm[]
     */
    public function getUpdateAction(): Collection
    {
        return $this->updateAction;
    }

    public function addUpdateAction(UpdateForm $updateAction): self
    {
        if (!$this->updateAction->contains($updateAction)) {
            $this->updateAction[] = $updateAction;
            $updateAction->setUpdateFieldId($this);
        }

        return $this;
    }

    public function removeUpdateAction(UpdateForm $updateAction): self
    {
        if ($this->updateAction->contains($updateAction)) {
            $this->updateAction->removeElement($updateAction);
            // set the owning side to null (unless already changed)
            if ($updateAction->getUpdateFieldId() === $this) {
                $updateAction->setUpdateFieldId(null);
            }
        }

        return $this;
    }

    public function getFieldTargetEntity(): ?string
    {
        return $this->fieldTargetEntity;
    }

    public function setFieldTargetEntity(?string $fieldTargetEntity): self
    {
        $this->fieldTargetEntity = $fieldTargetEntity;

        return $this;
    }

    public function getFieldTargetEntityId(): ?GestEntity
    {
        return $this->fieldTargetEntityId;
    }

    public function setFieldTargetEntityId(?GestEntity $fieldTargetEntityId): self
    {
        $this->fieldTargetEntityId = $fieldTargetEntityId;

        return $this;
    }

    public function getFieldExpression(): ?string
    {
        return $this->fieldExpression;
    }

    public function setFieldExpression(?string $fieldExpression): self
    {
        $this->fieldExpression = $fieldExpression;

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

    public function getFieldOrder(): ?int
    {
        return $this->fieldOrder;
    }

    public function setFieldOrder(?int $fieldOrder): self
    {
        $this->fieldOrder = $fieldOrder;

        return $this;
    }



}
