<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
    private $noment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoment(): ?string
    {
        return $this->noment;
    }

    public function setNoment(string $noment): self
    {
        $this->noment = $noment;

        return $this;
    }
}
