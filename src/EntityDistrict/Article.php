<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity
 */
class Article
{
    /**
     * @var string
     *
     * @ORM\Column(name="article_code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $articleCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="article_libelle", type="string", length=200, nullable=true)
     */
    private $articleLibelle;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="article_date_creation", type="datetime", nullable=true)
     */
    private $articleDateCreation;


}
