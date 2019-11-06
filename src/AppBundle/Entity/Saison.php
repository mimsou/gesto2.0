<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 * @ORM\Table(name="saison")
 * @ORM\Entity
 */
class Saison
{
	/**
	 * @var string
	 * @ORM\Column(name="code_saison", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeSaison;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_saison", type="string", length=100, nullable=true)
	 */
	private $libelleSaison;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeSaison($codeSaison)
               	{
               		$this->codeSaison = $codeSaison; return $this;
               	}

    public function getCodeSaison(): ?string
    {
        return $this->codeSaison;
    }

    public function getLibelleSaison(): ?string
    {
        return $this->libelleSaison;
    }

    public function setLibelleSaison(?string $libelleSaison): self
    {
        $this->libelleSaison = $libelleSaison;

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
