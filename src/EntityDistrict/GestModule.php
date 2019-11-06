<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestModule
 *
 * @ORM\Table(name="gest_module")
 * @ORM\Entity
 */
class GestModule
{
    /**
     * @var int
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $moduleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="module_libelle", type="string", length=100, nullable=true)
     */
    private $moduleLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="module_database_suffix", type="string", length=100, nullable=true)
     */
    private $moduleDatabaseSuffix;

    /**
     * @var string|null
     *
     * @ORM\Column(name="module_icone", type="string", length=100, nullable=true)
     */
    private $moduleIcone;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestEntity", mappedBy="moduleEntity")
     */
    private $entityModule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="moduleRole")
     */
    private $roleModule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entityModule = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roleModule = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
