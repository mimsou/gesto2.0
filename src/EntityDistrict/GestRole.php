<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestRole
 *
 * @ORM\Table(name="gest_role", indexes={@ORM\Index(name="IDX_C75DDE11A702C799", columns={"role_module"})})
 * @ORM\Entity
 */
class GestRole
{
    /**
     * @var int
     *
     * @ORM\Column(name="role_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $roleId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role_libelle", type="string", length=45, nullable=true)
     */
    private $roleLibelle;

    /**
     * @var int|null
     *
     * @ORM\Column(name="role_group", type="integer", nullable=true)
     */
    private $roleGroup;

    /**
     * @var \GestModule
     *
     * @ORM\ManyToOne(targetEntity="GestModule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_module", referencedColumnName="module_id")
     * })
     */
    private $roleModule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestMenu", mappedBy="role")
     */
    private $menu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestAccessPath", inversedBy="role")
     * @ORM\JoinTable(name="gest_role_access_path",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="rap_id", referencedColumnName="ap_id")
     *   }
     * )
     */
    private $rap;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestModule", inversedBy="roleModule")
     * @ORM\JoinTable(name="gest_role_module",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_module_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="module_role_id", referencedColumnName="module_id")
     *   }
     * )
     */
    private $moduleRole;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", inversedBy="gestRole")
     * @ORM\JoinTable(name="gest_role_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="gest_role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestActions", inversedBy="role")
     * @ORM\JoinTable(name="role_has_actions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="action_id", referencedColumnName="action_id")
     *   }
     * )
     */
    private $action;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestList", inversedBy="role")
     * @ORM\JoinTable(name="role_has_list",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="list_id", referencedColumnName="list_id")
     *   }
     * )
     */
    private $list;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="GestSteps", inversedBy="role")
     * @ORM\JoinTable(name="role_has_steps",
     *   joinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="role_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="step_id", referencedColumnName="step_id")
     *   }
     * )
     */
    private $step;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rap = new \Doctrine\Common\Collections\ArrayCollection();
        $this->moduleRole = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->action = new \Doctrine\Common\Collections\ArrayCollection();
        $this->list = new \Doctrine\Common\Collections\ArrayCollection();
        $this->step = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
