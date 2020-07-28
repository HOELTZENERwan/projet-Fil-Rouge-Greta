<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FraisRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FraisRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"read:frais"}},
 *  collectionOperations={"get","post"},
 *  itemOperations={"get","delete","patch"})
 */
class Frais
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:frais"})
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read:frais"})
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:frais"})
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:frais"})
     */
    private $scan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:frais"})
     */
    private $commentaire;

     /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="fraisCollection")
     * @ORM\JoinColumn(nullable=false)
     */
    public $idStatutFrais;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFrais::class, inversedBy="AllTypesFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTypeFrais;

    /**
     * @ORM\ManyToOne(targetEntity=Trajet::class, inversedBy="fraisAll")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTrajet;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="FraisAll")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="fraisAll")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommercial;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getScan(): ?string
    {
        return $this->scan;
    }

    public function setScan(?string $scan): self
    {
        $this->scan = $scan;

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

    public function getIdTypeFrais(): ?TypeFrais
    {
        return $this->idTypeFrais;
    }

    public function setIdTypeFrais(?TypeFrais $idTypeFrais): self
    {
        $this->idTypeFrais = $idTypeFrais;

        return $this;
    }

    public function getIdTrajet(): ?Trajet
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(?Trajet $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

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

    public function getIdCommercial(): ?Utilisateur
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Utilisateur $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

        return $this;
    }
}
