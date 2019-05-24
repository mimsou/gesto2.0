<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="gest_join_routes")
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
     * @var \GestProcess
     *
     * @ORM\ManyToOne(targetEntity="GestProcess" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_process", referencedColumnName="process_id"  )
     * })
     */
    private $routeProcess;


    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_start_entity", referencedColumnName="entity_id")
     * })
     */
    private $routeStartEntity;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_end_entity", referencedColumnName="entity_id")
     * })
     */
    private $routeEndEntity;


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

    public function getRouteId(): ?int
    {
        return $this->routeId;
    }

    public function getRoutePath(): ?string
    {
        return $this->routePath;
    }

    public function setRoutePath(?string $routePath): self
    {
        $this->routePath = $routePath;

        return $this;
    }

    public function getRouteState(): ?int
    {
        return $this->routeState;
    }

    public function setRouteState(?int $routeState): self
    {
        $this->routeState = $routeState;

        return $this;
    }

    public function getRouteProcess(): ?GestProcess
    {
        return $this->routeProcess;
    }

    public function setRouteProcess(?GestProcess $routeProcess): self
    {
        $this->routeProcess = $routeProcess;

        return $this;
    }

    public function getRouteStartEntity(): ?GestEntity
    {
        return $this->routeStartEntity;
    }

    public function setRouteStartEntity(?GestEntity $routeStartEntity): self
    {
        $this->routeStartEntity = $routeStartEntity;

        return $this;
    }

    public function getRouteEndEntity(): ?GestEntity
    {
        return $this->routeEndEntity;
    }

    public function setRouteEndEntity(?GestEntity $routeEndEntity): self
    {
        $this->routeEndEntity = $routeEndEntity;

        return $this;
    }


}
