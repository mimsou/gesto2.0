<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieJour
 *
 * @ORM\Table(name="categorie_jour")
 * @ORM\Entity
 */
class CategorieJour
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_categorie", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_categorie", type="string", length=50, nullable=false)
     */
    private $libelleCategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
