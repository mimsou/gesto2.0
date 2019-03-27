<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestRelations
 *
 * @ORM\Table(name="gest_relations", indexes={@ORM\Index(name="fk_gest_relations_gest_entity1_idx", columns={"relation_entitie"}), @ORM\Index(name="fk_gest_relations_gest_entity2_idx", columns={"relations_table"})})
 * @ORM\Entity
 */
class GestRelations
{
    /**
     * @var int
     *
     * @ORM\Column(name="relations_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $relationsId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="relation_table_name", type="string", length=150, nullable=true)
     */
    private $relationTableName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="relation_key", type="string", length=150, nullable=true)
     */
    private $relationKey;


    /**
     * @var string|null
     *
     * @ORM\Column(name="relation_inverse_key", type="string", length=150, nullable=true)
     */
    private $relationInverseKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="relation_is_dimention", type="string", length=150, nullable=true)
     */
    private $relationIsDimention;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" ,inversedBy="relations"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relation_entitie", referencedColumnName="entity_id")
     * })
     */
    private $relationEntitie;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relations_table", referencedColumnName="entity_id")
     * })
     */
    private $relationsTable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="checks", type="integer", nullable=true)
     */
    private $checks;

    public function getRelationsId(): ?int
    {
        return $this->relationsId;
    }

    public function getRelationTableName(): ?string
    {
        return $this->relationTableName;
    }

    public function setRelationTableName(?string $relationTableName): self
    {
        $this->relationTableName = $relationTableName;

        return $this;
    }

    public function getRelationKey(): ?string
    {
        return $this->relationKey;
    }

    public function setRelationKey(?string $relationKey): self
    {
        $this->relationKey = $relationKey;

        return $this;
    }

    public function getRelationIsDimention(): ?string
    {
        return $this->relationIsDimention;
    }

    public function setRelationIsDimention(?string $relationIsDimention): self
    {
        $this->relationIsDimention = $relationIsDimention;

        return $this;
    }

    public function getRelationEntitie(): ?GestEntity
    {
        return $this->relationEntitie;
    }

    public function setRelationEntitie(?GestEntity $relationEntitie): self
    {
        $this->relationEntitie = $relationEntitie;

        return $this;
    }

    public function getRelationsTable(): ?GestEntity
    {
        return $this->relationsTable;
    }

    public function setRelationsTable(?GestEntity $relationsTable): self
    {
        $this->relationsTable = $relationsTable;

        return $this;
    }

    public function getRelationInverseKey(): ?string
    {
        return $this->relationInverseKey;
    }

    public function setRelationInverseKey(?string $relationInverseKey): self
    {
        $this->relationInverseKey = $relationInverseKey;

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




}
