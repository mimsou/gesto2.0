<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Jour
 * @ORM\Table(name="jour")
 * @ORM\Entity
 */
class Jour
{
	/**
	 * @var datetime
	 * @ORM\Column(name="jour", type="datetime", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $jour;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;

	/**
	 * @var \CategorieJour
	 * @ORM\ManyToOne(targetEntity="CategorieJour")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_categorie", referencedColumnName="code_categorie")
	 * })
	 */
	private $codeCategorie;

	/**
	 * @var \Saison
	 * @ORM\ManyToOne(targetEntity="Saison")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="code_saison", referencedColumnName="code_saison")
	 * })
	 */
	private $codeSaison;


	public function setJour($jour)
                     	{
                     		$this->jour = $jour; return $this;
                     	}

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
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

    public function getCodeCategorie(): ?CategorieJour
    {
        return $this->codeCategorie;
    }

    public function setCodeCategorie(?CategorieJour $codeCategorie): self
    {
        $this->codeCategorie = $codeCategorie;

        return $this;
    }

    public function getCodeSaison(): ?Saison
    {
        return $this->codeSaison;
    }

    public function setCodeSaison(?Saison $codeSaison): self
    {
        $this->codeSaison = $codeSaison;

        return $this;
    }
}
