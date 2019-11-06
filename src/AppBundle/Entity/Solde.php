<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Solde
 * @ORM\Table(name="solde")
 * @ORM\Entity
 */
class Solde
{
	/**
	 * @var string
	 * @ORM\Column(name="crb_code", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $crbCode;

	/**
	 * @var float|null
	 * @ORM\Column(name="solde", type="float", length=100, nullable=true)
	 */
	private $solde;

	/**
	 * @var \Exercice
	 * @ORM\ManyToOne(targetEntity="Exercice",inversedBy="solde")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="exercice", referencedColumnName="exercice_code")
	 * })
	 */
	private $exercice;


	public function setCrbCode($crbCode)
               	{
               		$this->crbCode = $crbCode; return $this;
               	}

    public function getCrbCode(): ?string
    {
        return $this->crbCode;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getExercice(): ?Exercice
    {
        return $this->exercice;
    }

    public function setExercice(?Exercice $exercice): self
    {
        $this->exercice = $exercice;

        return $this;
    }
}
