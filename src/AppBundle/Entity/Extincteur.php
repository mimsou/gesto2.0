<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Extincteur
 * @ORM\Table(name="extincteur")
 * @ORM\Entity
 */
class Extincteur
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
	 * @ORM\Column(name="numero", type="string", length=100, nullable=true)
	 */
	private $numero;

	/**
	 * @var \Emplacement
	 * @ORM\ManyToOne(targetEntity="Emplacement")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="emplacement", referencedColumnName="id")
	 * })
	 */
	private $emplacement;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setId($id)
                     	{
                     		$this->id = $id; return $this;
                     	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(?int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getEmplacement(): ?Emplacement
    {
        return $this->emplacement;
    }

    public function setEmplacement(?Emplacement $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }
}
