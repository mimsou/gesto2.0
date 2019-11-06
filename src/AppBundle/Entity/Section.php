<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Section
 * @ORM\Table(name="section")
 * @ORM\Entity
 */
class Section
{
	/**
	 * @var string
	 * @ORM\Column(name="code_section", type="integer", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeSection;

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


	public function setCodeSection($codeSection)
               	{
               		$this->codeSection = $codeSection; return $this;
               	}

    public function getCodeSection(): ?int
    {
        return $this->codeSection;
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
