<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 * @ORM\Table(name="Test")
 * @ORM\Entity
 */
class Test
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;


	public function setId($id)
   	{
   		$this->id = $id; return $this;
   	}

    public function getId(): ?string
    {
        return $this->id;
    }
}
