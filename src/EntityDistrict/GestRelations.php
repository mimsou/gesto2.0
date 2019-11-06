<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestRelations
 *
 * @ORM\Table(name="gest_relations", indexes={@ORM\Index(name="fk_gest_relations_gest_entity2_idx", columns={"relations_table"}), @ORM\Index(name="fk_gest_relations_gest_entity1_idx", columns={"relation_entitie"})})
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
     * @var int|null
     *
     * @ORM\Column(name="checks", type="integer", nullable=true)
     */
    private $checks;

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
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relation_entitie", referencedColumnName="entity_id")
     * })
     */
    private $relationEntitie;


}
