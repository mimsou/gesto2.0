<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bus
 * @ORM\Table(name="bus")
 * @ORM\Entity
 */
class Bus
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;

	/**
	 * @var string|null
	 * @ORM\Column(name="matricule", type="string", length=100, nullable=true)
	 */
	private $matricule;

	/**
	 * @var \Type
	 * @ORM\ManyToOne(targetEntity="Type",inversedBy="typeColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="type", referencedColumnName="id")
	 * })
	 */
	private $type;


	public function setId($id)
               	{
               		$this->id = $id; return $this;
               	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
