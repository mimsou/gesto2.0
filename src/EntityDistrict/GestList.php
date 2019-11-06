<?php

namespace AppBundle\Entity;

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
     * @var int|null
     *
     * @ORM\Column(name="list_is_main", type="integer", nullable=true)
     */
    private $listIsMain;

    /**
     * @var int|null
     *
     * @ORM\Column(name="list_entity_name", type="integer", nullable=true)
     */
    private $listEntityName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="list_regle", type="string", length=2000, nullable=true)
     */
    private $listRegle;

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
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="list")
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", mappedBy="list")
     */
    private $step;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->field = new \Doctrine\Common\Collections\ArrayCollection();
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
