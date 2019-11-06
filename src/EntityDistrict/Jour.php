<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jour
 *
 * @ORM\Table(name="jour", indexes={@ORM\Index(name="Categorie", columns={"code_categorie"}), @ORM\Index(name="CodeSaison", columns={"code_saison"})})
 * @ORM\Entity
 */
class Jour
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Jour", type="date", nullable=false, options={"default"="0000-00-00"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $jour = '0000-00-00';

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;

    /**
     * @var \CategorieJour
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="CategorieJour")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_categorie", referencedColumnName="code_categorie")
     * })
     */
    private $codeCategorie;

    /**
     * @var \Saison
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Saison")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_saison", referencedColumnName="code_saison")
     * })
     */
    private $codeSaison;


}
