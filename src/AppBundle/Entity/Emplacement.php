<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 * @ORM\Table(name="Emplacement")
 * @ORM\Entity
 */
class Emplacement
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;

    public function getId(): ?string
    {
        return $this->id;
    }
}
