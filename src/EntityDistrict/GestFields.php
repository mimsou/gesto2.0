<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestFields
 *
 * @ORM\Table(name="gest_fields", indexes={@ORM\Index(name="fk_gest_fields_gest_entity1_idx", columns={"field_entity"}), @ORM\Index(name="IDX_DE28466CF71F86D2", columns={"field_target_entity_id"})})
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
     * @var string|null
     *
     * @ORM\Column(name="field_type", type="string", length=150, nullable=true)
     */
    private $fieldType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_target_entity", type="string", length=150, nullable=true)
     */
    private $fieldTargetEntity;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_nature", type="integer", nullable=true)
     */
    private $fieldNature;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_is_dimention", type="integer", nullable=true)
     */
    private $fieldIsDimention;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_length", type="string", length=150, nullable=true)
     */
    private $fieldLength;

    /**
     * @var string|null
     *
     * @ORM\Column(name="field_expression", type="string", length=2000, nullable=true)
     */
    private $fieldExpression;

    /**
     * @var int|null
     *
     * @ORM\Column(name="checks", type="integer", nullable=true)
     */
    private $checks;

    /**
     * @var int|null
     *
     * @ORM\Column(name="field_order", type="integer", nullable=true)
     */
    private $fieldOrder;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_entity", referencedColumnName="entity_id")
     * })
     */
    private $fieldEntity;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_target_entity_id", referencedColumnName="entity_id")
     * })
     */
    private $fieldTargetEntity2;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestList", mappedBy="field")
     */
    private $list;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="field")
     */
    private $process;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", mappedBy="updateField")
     */
    private $updateAction;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", mappedBy="viewField")
     */
    private $viewAction;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->process = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updateAction = new \Doctrine\Common\Collections\ArrayCollection();
        $this->viewAction = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
