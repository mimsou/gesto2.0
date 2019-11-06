<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * NatureVoyage
 * @ORM\Table(name="nature_voyage")
 * @ORM\Entity
 */
class NatureVoyage
{
	/**
	 * @var string
	 * @ORM\Column(name="code_nat_voy", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeNatVoy;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_nat_voy", type="string", length=100, nullable=true)
	 */
	private $libelleNatVoy;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeNatVoy($codeNatVoy)
               	{
               		$this->codeNatVoy = $codeNatVoy; return $this;
               	}

    public function getCodeNatVoy(): ?string
    {
        return $this->codeNatVoy;
    }

    public function getLibelleNatVoy(): ?string
    {
        return $this->libelleNatVoy;
    }

    public function setLibelleNatVoy(?string $libelleNatVoy): self
    {
        $this->libelleNatVoy = $libelleNatVoy;

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
