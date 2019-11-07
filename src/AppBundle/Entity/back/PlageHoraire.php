<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlageHoraire
 * @ORM\Table(name="plage_horaire")
 * @ORM\Entity
 */
class PlageHoraire
{
	/**
	 * @var string
	 * @ORM\Column(name="code_hr", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeHr;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_hr", type="string", length=100, nullable=true)
	 */
	private $libelleHr;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeHr($codeHr)
               	{
               		$this->codeHr = $codeHr; return $this;
               	}

    public function getCodeHr(): ?string
    {
        return $this->codeHr;
    }

    public function getLibelleHr(): ?string
    {
        return $this->libelleHr;
    }

    public function setLibelleHr(?string $libelleHr): self
    {
        $this->libelleHr = $libelleHr;

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
