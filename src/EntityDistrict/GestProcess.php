<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestProcess
 *
 * @ORM\Table(name="gest_process", indexes={@ORM\Index(name="IDX_21DAF352C6C8B88F", columns={"process_module"})})
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
     * @ORM\Column(name="process_menu_title", type="string", length=150, nullable=true)
     */
    private $processMenuTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="process_requiredim", type="string", length=150, nullable=true)
     */
    private $processRequiredim;

    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="process_module", referencedColumnName="module_id")
     * })
     */
    private $processModule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestEntity", inversedBy="process")
     * @ORM\JoinTable(name="process_has_dimention",
     *   joinColumns={
     *     @ORM\JoinColumn(name="process_id", referencedColumnName="process_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="entity_id", referencedColumnName="entity_id")
     *   }
     * )
     */
    private $entity;

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
     * @ORM\ManyToMany(targetEntity="GestFields", inversedBy="process")
     * @ORM\JoinTable(name="process_has_fielddimention",
     *   joinColumns={
     *     @ORM\JoinColumn(name="process_id", referencedColumnName="process_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="field_id", referencedColumnName="field_id")
     *   }
     * )
     */
    private $field;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gestEntity = new \Doctrine\Common\Collections\ArrayCollection();
        $this->field = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
