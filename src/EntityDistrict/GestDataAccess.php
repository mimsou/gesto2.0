<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestDataAccess
 *
 * @ORM\Table(name="gest_data_access", indexes={@ORM\Index(name="IDX_F6062B9F57698A6A", columns={"role"}), @ORM\Index(name="IDX_F6062B9F91B018B6", columns={"da_entity"})})
 * @ORM\Entity
 */
class GestDataAccess
{
    /**
     * @var int
     *
     * @ORM\Column(name="da_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $daId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="da_mode", type="string", length=200, nullable=true)
     */
    private $daMode;

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
     *   @ORM\JoinColumn(name="da_entity", referencedColumnName="entity_id")
     * })
     */
    private $daEntity;


}
