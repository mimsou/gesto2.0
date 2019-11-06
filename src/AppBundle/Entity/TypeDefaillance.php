<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeDefaillance
 * @ORM\Table(name="type_defaillance")
 * @ORM\Entity
 */
class TypeDefaillance
{
	/**
	 * @var string
	 * @ORM\Column(name="code_type_def", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeTypeDef;

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


	public function setCodeTypeDef($codeTypeDef)
               	{
               		$this->codeTypeDef = $codeTypeDef; return $this;
               	}

    public function getCodeTypeDef(): ?string
    {
        return $this->codeTypeDef;
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
