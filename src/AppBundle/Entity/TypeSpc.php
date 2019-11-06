<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeSpc
 * @ORM\Table(name="type_spc")
 * @ORM\Entity
 */
class TypeSpc
{
	/**
	 * @var string
	 * @ORM\Column(name="code_spc", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeSpc;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_spc", type="string", length=100, nullable=true)
	 */
	private $libelleSpc;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeSpc($codeSpc)
               	{
               		$this->codeSpc = $codeSpc; return $this;
               	}

    public function getCodeSpc(): ?string
    {
        return $this->codeSpc;
    }

    public function getLibelleSpc(): ?string
    {
        return $this->libelleSpc;
    }

    public function setLibelleSpc(?string $libelleSpc): self
    {
        $this->libelleSpc = $libelleSpc;

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
}
