<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLigne
 * @ORM\Table(name="type_ligne")
 * @ORM\Entity
 */
class TypeLigne
{
	/**
	 * @var string
	 * @ORM\Column(name="code_type_lig", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeTypeLig;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_type_lig", type="string", length=100, nullable=true)
	 */
	private $libelleTypeLig;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeTypeLig($codeTypeLig)
               	{
               		$this->codeTypeLig = $codeTypeLig; return $this;
               	}

    public function getCodeTypeLig(): ?string
    {
        return $this->codeTypeLig;
    }

    public function getLibelleTypeLig(): ?string
    {
        return $this->libelleTypeLig;
    }

    public function setLibelleTypeLig(?string $libelleTypeLig): self
    {
        $this->libelleTypeLig = $libelleTypeLig;

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
