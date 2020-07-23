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
}
