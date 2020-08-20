<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ApiResource
 * @UniqueEntity(fields= {"email"},
 * message= "Cette adresse email est déjà enregistrée")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email()
     * @Groups({"public"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string The hashed password
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit contenir au minimum 8 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Les mots de passe doivent être identiques")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe doivent être identiques")
     */
    public $confirm_password;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idCommercial", orphanRemoval=true)
     */
    private $fraisAll;


    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


  /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;
    



    public function __construct()
    {
        $this->fraisAll = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

     /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): ?string
    {
        return (string) $this->email;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


     /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Frais[]
     */
    public function getFraisAll(): Collection
    {
        return $this->fraisAll;
    }

    public function addFraisAll(Frais $fraisAll): self
    {
        if (!$this->fraisAll->contains($fraisAll)) {
            $this->fraisAll[] = $fraisAll;
            $fraisAll->setIdCommercial($this);
        }

        return $this;
    }

    public function removeFraisAll(Frais $fraisAll): self
    {
        if ($this->fraisAll->contains($fraisAll)) {
            $this->fraisAll->removeElement($fraisAll);
            // set the owning side to null (unless already changed)
            if ($fraisAll->getIdCommercial() === $this) {
                $fraisAll->setIdCommercial(null);
            }
        }

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array{

        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //à modifier après pour vraiment distinguer les roles 
        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;

    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(){
        // If you store any temporary, sensitive data on the user, clear it here
            // $this->plainPassword = null;
        }


    /**
     * @see UserInterface
     */
    public function getSalt(): ?string {
        //pas besoin si on utilise l'algo bcrypt sur security.yaml
        return null;
    }

    public function __toString()
    {
        return $this->prenom.' '.$this->nom;
    }
}
