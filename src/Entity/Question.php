<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=MyResponse::class, mappedBy="question")
     */
    private $myResponses;

    /**
     * @ORM\Column(type="boolean")
     */
    private $valide;

    public function __construct()
    {
        $this->myResponses = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->text;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|MyResponse[]
     */
    public function getMyResponses(): Collection
    {
        return $this->myResponses;
    }

    public function addMyResponse(MyResponse $myResponse): self
    {
        if (!$this->myResponses->contains($myResponse)) {
            $this->myResponses[] = $myResponse;
            $myResponse->setQuestion($this);
        }

        return $this;
    }

    public function removeMyResponse(MyResponse $myResponse): self
    {
        if ($this->myResponses->removeElement($myResponse)) {
            // set the owning side to null (unless already changed)
            if ($myResponse->getQuestion() === $this) {
                $myResponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }
}
