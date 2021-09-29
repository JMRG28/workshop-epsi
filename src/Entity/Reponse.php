<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
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
    private $reponse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $resultat;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponses")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getResultat(): ?bool
    {
        return $this->resultat;
    }

    public function setResultat(bool $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getQuestion(): ?question
    {
        return $this->question;
    }

    public function setQuestion(?question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
