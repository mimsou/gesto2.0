<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestAccessPath
 *
 * @ORM\Table(name="gest_data_access")
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
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" , inversedBy="daAccessData"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="da_entity", referencedColumnName="entity_id")
     * })
     */
    private $daEntity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="da_mode", type="string", length=200, nullable=true)
     */
    private $daMode;

    /**
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestRole" , inversedBy="rda"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="role_id")
     * })
     */
    private $role;

    public function __construct()
    {
        $this->role = new ArrayCollection();
    }

    public function getDaId(): ?int
    {
        return $this->daId;
    }



    public function getDaMode(): ?string
    {
        return $this->daMode;
    }

    public function setDaMode(?string $daMode): self
    {
        $this->daMode = $daMode;

        return $this;
    }



    public function getDaEntity(): ?GestEntity
    {
        return $this->daEntity;
    }

    public function setDaEntity(?GestEntity $daEntity): self
    {
        $this->daEntity = $daEntity;

        return $this;
    }

    public function getRole(): ?GestRole
    {
        return $this->role;
    }

    public function setRole(?GestRole $role): self
    {
        $this->role = $role;

        return $this;
    }

}
