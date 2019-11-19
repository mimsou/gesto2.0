<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DepechDetail
 * @ORM\Table(name="DepechDetail")
 * @ORM\Entity
 */
class DepechDetail
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;

	/**
	 * @var \DepechEntete
	 * @ORM\ManyToOne(targetEntity="DepechEntete",inversedBy="depecheCodeColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="depeche_code", referencedColumnName="id")
	 * })
	 */
	private $depecheCode;


	public function setId($id)
         	{
         		$this->id = $id; return $this;
         	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDepecheCode(): ?DepechEntete
    {
        return $this->depecheCode;
    }

    public function setDepecheCode(?DepechEntete $depecheCode): self
    {
        $this->depecheCode = $depecheCode;

        return $this;
    }
}
