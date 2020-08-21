<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FraisRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Symonfy\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=FraisRepository::class)
 * @Vich\Uploadable()
 * @ApiResource(
 *  normalizationContext={"groups"={"read:frais"}},
 *  collectionOperations={"get","post"},
 *  itemOperations={"get","delete","patch"})
 * @ApiFilter(SearchFilter::class,
 * properties={"utilisateur":"exact"})
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
     * @var string
     */
    private $scan;

    /**
     * @var File
     * @Vich\UploadableField(mapping="scan_images", fileNameProperty="scan")
     */
    private $scanFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:frais"})
     */
    private $commentaire;

     /**
     * @ORM\ManyToOne(targetEntity=StatutFrais::class, inversedBy="fraisCollection")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read:frais"})
     */
    public $idStatutFrais;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFrais::class, inversedBy="AllTypesFrais")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read:frais"})
     */
    private $idTypeFrais;

    /**
     * @ORM\ManyToOne(targetEntity=Trajet::class, inversedBy="fraisAll")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read:frais"})
     */
    private $idTrajet;

 
    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="fraisAll")
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"read:frais"})
     */
    private $idCommercial;

    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

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

  
    /**
     * @return string|null
     */
    public function getScan(): ?string
    {
        return $this->scan;
    }


    /**
     * @param string|null $scan
     * @return $this
    */
    public function setScan(?string $scan): self
    {
        $this->scan = $scan;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getScanFile(): ?File
    {
        return $this->scanFile;
    }

     /**
     * @param File|null $scanFile
     */
    public function setScanFile(?File $scanFile=null)
    {
        $this->scanFile = $scanFile;

        //on rajoute un changement de propriété pour que les event listeners soient déclenchés
        //par Doctrine, car sinon le fichier est perdu
        if(null !== $scanFile){
            $this->updatedAt = new \DateTime();
        }
        
     
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

    public function getIdCommercial(): ?Utilisateur
    {
        return $this->idCommercial;
    }

    public function setIdCommercial(?Utilisateur $idCommercial): self
    {
        $this->idCommercial = $idCommercial;

        return $this;
    }

    // public function __toString(){

    // }
}
