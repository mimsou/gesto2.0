<?php

namespace AppBundle\Entity;

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
    private $entityDisplayField;

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
     * @var int|null
     *
     * @ORM\Column(name="checks", type="integer", nullable=true)
     */
    private $checks;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestModule", inversedBy="entityModule")
     * @ORM\JoinTable(name="gest_module_entity",
     *   joinColumns={
     *     @ORM\JoinColumn(name="entity_module_id", referencedColumnName="entity_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="module_entity_id", referencedColumnName="module_id")
     *   }
     * )
     */
    private $moduleEntity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="entity")
     */
    private $process;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestProcess", mappedBy="gestEntity")
     */
    private $gestProcess;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->moduleEntity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->process = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestProcess = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
