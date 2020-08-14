<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ApiResource
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="string", length=255)
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
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idRole;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idCommercial", orphanRemoval=true)
     */
    private $fraisAll;

    public function __construct()
    {
        $this->fraisAll = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIdRole(): ?role
    {
        return $this->idRole;
    }

    public function setIdRole(?role $idRole): self
    {
        $this->idRole = $idRole;

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
}
