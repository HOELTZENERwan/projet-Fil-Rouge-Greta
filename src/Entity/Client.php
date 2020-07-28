<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:client"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:client"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"read:client"})
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idClient", orphanRemoval=true)
     */
    private $FraisAll;

    /**
     * @ORM\OneToMany(targetEntity=Trajet::class, mappedBy="idClient", orphanRemoval=true)
     */
    private $AllTrajets;

    public function __construct()
    {
        $this->FraisAll = new ArrayCollection();
        $this->AllTrajets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|Frais[]
     */
    public function getFraisAll(): Collection
    {
        return $this->FraisAll;
    }

    public function addFraisAll(Frais $fraisAll): self
    {
        if (!$this->FraisAll->contains($fraisAll)) {
            $this->FraisAll[] = $fraisAll;
            $fraisAll->setIdClient($this);
        }

        return $this;
    }

    public function removeFraisAll(Frais $fraisAll): self
    {
        if ($this->FraisAll->contains($fraisAll)) {
            $this->FraisAll->removeElement($fraisAll);
            // set the owning side to null (unless already changed)
            if ($fraisAll->getIdClient() === $this) {
                $fraisAll->setIdClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getAllTrajets(): Collection
    {
        return $this->AllTrajets;
    }

    public function addTrajet(Trajet $trajet): self
    {
        if (!$this->AllTrajets->contains($trajet)) {
            $this->AllTrajets[] = $trajet;
            $allTrajet->setIdClient($this);
        }

        return $this;
    }

    public function removeTrajet(Trajet $trajet): self
    {
        if ($this->AllTrajets->contains($trajet)) {
            $this->AllTrajets->removeElement($trajet);
            // set the owning side to null (unless already changed)
            if ($allTrajet->getIdClient() === $this) {
                $allTrajet->setIdClient(null);
            }
        }

        return $this;
    }
}
