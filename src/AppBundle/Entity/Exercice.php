<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Crb
 *
 * @ORM\Table(name="exercice")
 * @ORM\Entity
 */
class Exercice
{


    /**
     * @var string
     *
     * @ORM\Column(name="exercice_code", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $exerciceCode;


    /**
     * @var string|null
     *
     * @ORM\Column(name="exercice_libelle", type="integer", length=100, nullable=true)
     */
    private $exerciceLibelle;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Facture", mappedBy="factureExerice" , cascade={"persist"})
     */

    private  $facture;
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Bcn", mappedBy="bcnExerice" , cascade={"persist"})
     */

    private  $bcn;


    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Renouvellement", mappedBy="renouvellementExercice" , cascade={"persist"})
     */

    private  $renouvellement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Solde", mappedBy="exercice" , cascade={"persist"})
     */

    private  $solde;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facture = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bcn = new \Doctrine\Common\Collections\ArrayCollection();
        $this->renouvellement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solde = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getExerciceLibelle(): ?int
    {
        return $this->exerciceLibelle;
    }

    public function setExerciceLibelle(?int $exerciceLibelle): self
    {
        $this->exerciceLibelle = $exerciceLibelle;

        return $this;
    }


    public function setExerciceCode(?int $exerciceCode): self
    {
        $this->exerciceCode = $exerciceCode;

        return $this;
    }

    public function getExerciceCode(): ?int
    {
        return $this->exerciceCode;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture[] = $facture;
            $facture->setFactureExerice($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->facture->contains($facture)) {
            $this->facture->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getFactureExerice() === $this) {
                $facture->setFactureExerice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bcn[]
     */
    public function getBcn(): Collection
    {
        return $this->bcn;
    }

    public function addBcn(Bcn $bcn): self
    {
        if (!$this->bcn->contains($bcn)) {
            $this->bcn[] = $bcn;
            $bcn->setBcnExerice($this);
        }

        return $this;
    }

    public function removeBcn(Bcn $bcn): self
    {
        if ($this->bcn->contains($bcn)) {
            $this->bcn->removeElement($bcn);
            // set the owning side to null (unless already changed)
            if ($bcn->getBcnExerice() === $this) {
                $bcn->setBcnExerice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Renouvellement[]
     */
    public function getRenouvellement(): Collection
    {
        return $this->renouvellement;
    }

    public function addRenouvellement(Renouvellement $renouvellement): self
    {
        if (!$this->renouvellement->contains($renouvellement)) {
            $this->renouvellement[] = $renouvellement;
            $renouvellement->setRenouvellementExercice($this);
        }

        return $this;
    }

    public function removeRenouvellement(Renouvellement $renouvellement): self
    {
        if ($this->renouvellement->contains($renouvellement)) {
            $this->renouvellement->removeElement($renouvellement);
            // set the owning side to null (unless already changed)
            if ($renouvellement->getRenouvellementExercice() === $this) {
                $renouvellement->setRenouvellementExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Solde[]
     */
    public function getSolde(): Collection
    {
        return $this->solde;
    }

    public function addSolde(Solde $solde): self
    {
        if (!$this->solde->contains($solde)) {
            $this->solde[] = $solde;
            $solde->setRenouvellementExercice($this);
        }

        return $this;
    }

    public function removeSolde(Solde $solde): self
    {
        if ($this->solde->contains($solde)) {
            $this->solde->removeElement($solde);
            // set the owning side to null (unless already changed)
            if ($solde->getRenouvellementExercice() === $this) {
                $solde->setRenouvellementExercice(null);
            }
        }

        return $this;
    }




}
