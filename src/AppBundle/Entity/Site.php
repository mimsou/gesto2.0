<?php 
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 * @ORM\Table(name="site")
 * @ORM\Entity
 */
class Site
{
	/**
	 * @var string
	 * @ORM\Column(name="code_site", type="string", length=10, nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="NONE")
	 */
	private $codeSite;

	/**
	 * @var string|null
	 * @ORM\Column(name="lib_site", type="string", length=100, nullable=true)
	 */
	private $libSite;

	/**
	 * @var integer|null
	 * @ORM\Column(name="etat", type="integer", length=100, nullable=true)
	 */
	private $etat;


	public function setCodeSite($codeSite)
               	{
               		$this->codeSite = $codeSite; return $this;
               	}

    public function getCodeSite(): ?string
    {
        return $this->codeSite;
    }

    public function getLibSite(): ?string
    {
        return $this->libSite;
    }

    public function setLibSite(?string $libSite): self
    {
        $this->libSite = $libSite;

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
