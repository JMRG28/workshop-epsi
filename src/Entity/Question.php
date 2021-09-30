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
     * @ORM\Column(type="text", length=100)
     */
    private $enonce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255,  columnDefinition="enum('easy', 'medium' , 'hard')", nullable=true)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity=Quizz::class, mappedBy="question")
     */
    private $quizzs;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="question")
     */
    private $reponses;

    /**
     * @ORM\ManyToOne(targetEntity=Cour::class, inversedBy="question")
     */
    private $cour;

    public function __construct()
    {
        $this->quizzs = new ArrayCollection();
        $this->reponses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnonce(): ?string
    {
        return $this->enonce;
    }

    public function setEnonce(string $enonce): self
    {
        $this->enonce = $enonce;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setDifficulte(?string $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection|Quizz[]
     */
    public function getQuizzs(): Collection
    {
        return $this->quizzs;
    }

    public function addQuizz(Quizz $quizz): self
    {
        if (!$this->quizzs->contains($quizz)) {
            $this->quizzs[] = $quizz;
            $quizz->addQuestion($this);
        }

        return $this;
    }

    public function removeQuizz(Quizz $quizz): self
    {
        if ($this->quizzs->removeElement($quizz)) {
            $quizz->removeQuestion($this);
        }

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getCour(): ?Cour
    {
        return $this->cour;
    }

    public function setCour(?Cour $cour): self
    {
        $this->cour = $cour;

        return $this;
    }
}
