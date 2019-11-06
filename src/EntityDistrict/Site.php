<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="site", indexes={@ORM\Index(name="code_site_2", columns={"code_site"}), @ORM\Index(name="code_site", columns={"code_site"})})
 * @ORM\Entity
 */
class Site
{
    /**
     * @var string
     *
     * @ORM\Column(name="code_site", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeSite;

    /**
     * @var string
     *
     * @ORM\Column(name="lib_site", type="string", length=30, nullable=false)
     */
    private $libSite;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     */
    private $etat;


}
