<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestMenu
 *
 * @ORM\Table(name="gest_menu", indexes={@ORM\Index(name="IDX_ED316EE8DF637EF0", columns={"menu_module"}), @ORM\Index(name="IDX_ED316EE8EEC93897", columns={"menu_parent"})})
 * @ORM\Entity
 */
class GestMenu
{
    /**
     * @var int
     *
     * @ORM\Column(name="menu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $menuId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu_libelle", type="string", length=100, nullable=true)
     */
    private $menuLibelle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu_tag", type="string", length=100, nullable=true)
     */
    private $menuTag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="menu_interface", type="string", length=100, nullable=true)
     */
    private $menuInterface;

    /**
     * @var int|null
     *
     * @ORM\Column(name="menu_process", type="integer", nullable=true)
     */
    private $menuProcess;

    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_module", referencedColumnName="module_id")
     * })
     */
    private $menuModule;

    /**
     * @var \GestMenu
     *
     * @ORM\ManyToOne(targetEntity="GestMenu")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="menu_parent", referencedColumnName="menu_id")
     * })
     */
    private $menuParent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestRole", inversedBy="menu")
     * @ORM\JoinTable(name="gest_menu_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="menu_id", referencedColumnName="menu_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   }
     * )
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
