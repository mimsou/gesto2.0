<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 * @ORM\Table(name="Test")
 * @ORM\Entity
 */
class Test
{
	/**
	 * @var string
	 * @ORM\Column(name="id", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $id;

	/**
	 * @var string|null
	 * @ORM\Column(name="libelle_test", type="string", length=100, nullable=true)
	 */
	private $libelleTest;

	/**
	 * @var \Fournisseur
	 * @ORM\ManyToOne(targetEntity="Fournisseur",inversedBy="FournisseurTestColl")
	 * @ORM\JoinColumns({
	 * @ORM\JoinColumn(name="fournisseur_test", referencedColumnName="fournisseur_code")
	 * })
	 */
	private $FournisseurTest;

	/**
	 * @var integer|null
	 * @ORM\Column(name="test_etat", type="integer", length=100, nullable=true)
	 */
	private $testEtat;


	public function setId($id)
                     	{
                     		$this->id = $id; return $this;
                     	}

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLibelleTest(): ?string
    {
        return $this->libelleTest;
    }

    public function setLibelleTest(?string $libelleTest): self
    {
        $this->libelleTest = $libelleTest;

        return $this;
    }

    public function getTestEtat(): ?int
    {
        return $this->testEtat;
    }

    public function setTestEtat(?int $testEtat): self
    {
        $this->testEtat = $testEtat;

        return $this;
    }

    public function getFournisseurTest(): ?Fournisseur
    {
        return $this->FournisseurTest;
    }

    public function setFournisseurTest(?Fournisseur $FournisseurTest): self
    {
        $this->FournisseurTest = $FournisseurTest;

        return $this;
    }
}
