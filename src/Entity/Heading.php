<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Twig\AppExtension;


/**
 * @ORM\Entity(repositoryClass="App\Repository\HeadingRepository")
 */
class Heading
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     * @Assert\Length(
     * min = 3,
     * minMessage = "Votre titre doit contenir au minimum {{ limit }} caractères",
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="heading")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\HeadingType", mappedBy="heading")
     */
    private $headingTypes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->headingTypes = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setHeading($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getHeading() === $this) {
                $article->setHeading(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HeadingType[]
     */
    public function getHeadingTypes(): Collection
    {
        return $this->headingTypes;
    }

    public function addHeadingType(HeadingType $headingType): self
    {
        if (!$this->headingTypes->contains($headingType)) {
            $this->headingTypes[] = $headingType;
            $headingType->setHeading($this);
        }

        return $this;
    }

    public function removeHeadingType(HeadingType $headingType): self
    {
        if ($this->headingTypes->contains($headingType)) {
            $this->headingTypes->removeElement($headingType);
            // set the owning side to null (unless already changed)
            if ($headingType->getHeading() === $this) {
                $headingType->setHeading(null);
            }
        }

        return $this;
    }


}
