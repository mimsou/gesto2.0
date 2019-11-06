<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestAccessPath
 *
 * @ORM\Table(name="gest_access_path")
 * @ORM\Entity
 */
class GestAccessPath
{
    /**
     * @var int
     *
     * @ORM\Column(name="ap_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $apId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ap_controller", type="string", length=200, nullable=true)
     */
    private $apController;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ap_libelle", type="string", length=200, nullable=true)
     */
    private $apLibelle;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", mappedBy="rap")
     */
    private $role;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
