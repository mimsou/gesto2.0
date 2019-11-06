<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestRoleData
 *
 * @ORM\Table(name="gest_role_data", indexes={@ORM\Index(name="IDX_8B020F8A57698A6A", columns={"role"}), @ORM\Index(name="IDX_8B020F8A68A2D29", columns={"rd_entity"})})
 * @ORM\Entity
 */
class GestRoleData
{
    /**
     * @var int
     *
     * @ORM\Column(name="rd_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rdId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rd_data", type="string", length=200, nullable=true)
     */
    private $rdData;

    /**
     * @var \GestRole
     *
     * @ORM\ManyToOne(targetEntity="GestRole")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="role_id")
     * })
     */
    private $role;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rd_entity", referencedColumnName="entity_id")
     * })
     */
    private $rdEntity;


}
