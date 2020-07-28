<?php

namespace App\Entity;

use App\Repository\TrajetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrajetRepository::class)
 */
class Trajet
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
    private $label;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idTrajet", orphanRemoval=true)
     */
    private $fraisAll;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="AllTrajets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    public function __construct()
    {
        $this->fraisAll = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->label;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
            $fraisAll->setIdTrajet($this);
        }

        return $this;
    }

    public function removeFraisAll(Frais $fraisAll): self
    {
        if ($this->fraisAll->contains($fraisAll)) {
            $this->fraisAll->removeElement($fraisAll);
            // set the owning side to null (unless already changed)
            if ($fraisAll->getIdTrajet() === $this) {
                $fraisAll->setIdTrajet(null);
            }
        }

        return $this;
    }

    public function getIdClient(): ?Client
    {
        return $this->idClient;
    }

    public function setIdClient(?Client $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }
}
