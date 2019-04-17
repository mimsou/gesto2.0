<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GestRoleAccess
 *
 * @ORM\Table(name="gest_role_data")
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
     * @var \GestEntity
     *
     * @ORM\ManyToOne(targetEntity="GestEntity" , inversedBy="rdAccessData"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rd_entity", referencedColumnName="entity_id")
     * })
     */
    private $rdEntity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rd_data", type="string", length=200, nullable=true)
     */
    private $rdData;

    /**
     * @var \GestRole
     *
     * @ORM\ManyToOne(targetEntity="GestRole" , inversedBy="dra"  )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role", referencedColumnName="role_id")
     * })
     */
    private $role;

    public function __construct()
    {
        $this->role = new ArrayCollection();
    }

    public function getRdId(): ?int
    {
        return $this->rdId;
    }

    public function getRdData(): ?string
    {
        return $this->rdData;
    }

    public function setRdData(?string $rdData): self
    {
        $this->rdData = $rdData;

        return $this;
    }

    public function getRdEntity(): ?GestEntity
    {
        return $this->rdEntity;
    }

    public function setRdEntity(?GestEntity $rdEntity): self
    {
        $this->rdEntity = $rdEntity;

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
