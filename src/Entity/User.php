<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *     fields = {"email"},
 *     message= "Pseudo pas disponible"
 * )
 * @method string getUserIdentifier()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     *@Assert\Length(min=5,max=15,minMessage="Le mdp doit faire entre 5 et 15 caractères",max=15,maxMessage="Le mdp doit faire entre 5 et 15 caractères")
     *@Assert\EqualTo(propertyPath="password",message="Mot de passe différent")
     */
    private $verificationPassword;


    public function getVerificationPassword() :?string
    {
        return $this->verificationPassword;
    }


    public function setVerificationPassword($verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;
        return $this;
    }
    /**
     * @ORM\ManyToMany(targetEntity=quizz::class, inversedBy="users")
     */
    private $quizz;

    /**
     * @ORM\ManyToOne(targetEntity=entreprise::class, inversedBy="users")
     */
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function __construct()
    {
        $this->quizz = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getSalt(): ?string
    {
        return null;
    }


    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|quizz[]
     */
    public function getQuizz(): Collection
    {
        return $this->quizz;
    }

    public function addQuizz(quizz $quizz): self
    {
        if (!$this->quizz->contains($quizz)) {
            $this->quizz[] = $quizz;
        }

        return $this;
    }

    public function removeQuizz(quizz $quizz): self
    {
        $this->quizz->removeElement($quizz);

        return $this;
    }

    public function getEntreprise(): ?entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

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
}
