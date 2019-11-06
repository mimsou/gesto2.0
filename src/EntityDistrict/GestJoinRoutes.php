<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GestJoinRoutes
 *
 * @ORM\Table(name="gest_join_routes", indexes={@ORM\Index(name="IDX_AAA6E477044E547", columns={"route_end_entity"}), @ORM\Index(name="IDX_AAA6E477E4E450E", columns={"route_process"}), @ORM\Index(name="IDX_AAA6E47AE69930A", columns={"route_start_entity"})})
 * @ORM\Entity
 */
class GestJoinRoutes
{
    /**
     * @var int
     *
     * @ORM\Column(name="route_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $routeId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="route_path", type="string", length=5000, nullable=true)
     */
    private $routePath;

    /**
     * @var int|null
     *
     * @ORM\Column(name="route_state", type="integer", nullable=true)
     */
    private $routeState;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_end_entity", referencedColumnName="entity_id")
     * })
     */
    private $routeEndEntity;

    /**
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_process", referencedColumnName="process_id")
     * })
     */
    private $routeProcess;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_start_entity", referencedColumnName="entity_id")
     * })
     */
    private $routeStartEntity;


}
