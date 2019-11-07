<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NatureLigne
 * @ORM\Table(name="nature_ligne")
 * @ORM\Entity
 */
class NatureLigne
{
	/**
	 * @var string
	 * @ORM\Column(name="code_nature_ligne", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeNatureLigne;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_nature_ligne", type="string", length=100, nullable=true)
	 */
	private $libelleNatureLigne;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeNatureLigne($codeNatureLigne)
               	{
               		$this->codeNatureLigne = $codeNatureLigne; return $this;
               	}

    public function getCodeNatureLigne(): ?string
    {
        return $this->codeNatureLigne;
    }

    public function getLibelleNatureLigne(): ?string
    {
        return $this->libelleNatureLigne;
    }

    public function setLibelleNatureLigne(?string $libelleNatureLigne): self
    {
        $this->libelleNatureLigne = $libelleNatureLigne;

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
