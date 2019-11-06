<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $articleCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ArticleBcn", mappedBy="articleBcnCode" , cascade={"persist"})
     */
    private $articleDetail;

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

    public function __construct()
    {
        $this->bcnDetail = new ArrayCollection();
        $this->articleDetail = new ArrayCollection();
    }

    public function getArticleCode(): ?string
    {
        return $this->articleCode;
    }

    public function setArticleCode(?string $articleCode): self
    {
        $this->articleCode = $articleCode;

        return $this;
    }

    public function getArticleLibelle(): ?string
    {
        return $this->articleLibelle;
    }

    public function setArticleLibelle(?string $articleLibelle): self
    {
        $this->articleLibelle = $articleLibelle;

        return $this;
    }

    public function getArticleDateCreation(): ?\DateTimeInterface
    {
        return $this->articleDateCreation;
    }

    public function setArticleDateCreation(?\DateTimeInterface $articleDateCreation): self
    {
        $this->articleDateCreation = $articleDateCreation;

        return $this;
    }

    /**
     * @return Collection|ArticleBcn[]
     */
    public function getArticleDetail(): Collection
    {
        return $this->articleDetail;
    }

    public function addArticleDetail(ArticleBcn $articleDetail): self
    {
        if (!$this->articleDetail->contains($articleDetail)) {
            $this->articleDetail[] = $articleDetail;
            $articleDetail->setArticleBcnCode($this);
        }

        return $this;
    }

    public function removeArticleDetail(ArticleBcn $articleDetail): self
    {
        if ($this->articleDetail->contains($articleDetail)) {
            $this->articleDetail->removeElement($articleDetail);
            // set the owning side to null (unless already changed)
            if ($articleDetail->getArticleBcnCode() === $this) {
                $articleDetail->setArticleBcnCode(null);
            }
        }

        return $this;
    }


}
