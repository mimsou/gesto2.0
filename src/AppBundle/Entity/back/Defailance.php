<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Defailance
 * @ORM\Table(name="defailance")
 * @ORM\Entity
 */
class Defailance
{
	/**
	 * @var string
	 * @ORM\Column(name="code_defaillance", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeDefaillance;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle", type="string", length=100, nullable=true)
	 */
	private $libelle;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeDefaillance($codeDefaillance)
               	{
               		$this->codeDefaillance = $codeDefaillance; return $this;
               	}

    public function getCodeDefaillance(): ?string
    {
        return $this->codeDefaillance;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

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
