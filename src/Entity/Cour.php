<?php

namespace App\Entity;

use App\Repository\CourRepository;
use App\YTB\YtbScrapper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CourRepository::class)
 */
class Cour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textcours;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="cour")
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_ytb;

    public function __construct()
    {
        $this->question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getTextcours(): ?string
    {
        return $this->textcours;
    }

    public function setTextcours(?string $textcours): self
    {
        $this->textcours = $textcours;

        return $this;
    }

    /**
     * @return Collection|question[]
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
            $question->setCour($this);
        }

        return $this;
    }

    public function removeQuestion(question $question): self
    {
        if ($this->question->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getCour() === $this) {
                $question->setCour(null);
            }
        }

        return $this;
    }

    public function getUrlYtb(): ?string
    {
        return $this->url_ytb;
    }

    public function setUrlYtb(?string $url_ytb): self
    {
       // $this->url_ytb = YtbScrapper::getVideo($this->intitule,$this->textcours);
$this->url_ytb = $url_ytb;
        return $this;
    }
}
