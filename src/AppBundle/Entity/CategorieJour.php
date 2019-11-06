<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieJour
 * @ORM\Table(name="categorie_jour")
 * @ORM\Entity
 */
class CategorieJour
{
	/**
	 * @var string
	 * @ORM\Column(name="code_categorie", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeCategorie;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_categorie", type="string", length=100, nullable=true)
	 */
	private $libelleCategorie;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeCategorie($codeCategorie)
               	{
               		$this->codeCategorie = $codeCategorie; return $this;
               	}

    public function getCodeCategorie(): ?string
    {
        return $this->codeCategorie;
    }

    public function getLibelleCategorie(): ?string
    {
        return $this->libelleCategorie;
    }

    public function setLibelleCategorie(?string $libelleCategorie): self
    {
        $this->libelleCategorie = $libelleCategorie;

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
