<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeFraisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=TypeFraisRepository::class)
 */
class TypeFrais
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
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idTypeFrais")
     */
    private $AllTypesFrais;

    public function __construct()
    {
        $this->AllTypesFrais = new ArrayCollection();
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

    /**
     * @return Collection|Frais[]
     */
    public function getAllTypesFrais(): Collection
    {
        return $this->AllTypesFrais;
    }

    public function addTypeFrais(Frais $typeFrais): self
    {
        if (!$this->AllTypesFrais->contains($typeFrais)) {
            $this->AllTypesFrais[] = $typeFrais;
            $typeFrais->setIdTypeFrais($this);
        }

        return $this;
    }

    public function removeTypeFrais(Frais $typeFrais): self
    {
        if ($this->AllTypesFrais->contains($typeFrais)) {
            $this->AllTypesFrais->removeElement($typeFrais);
            // set the owning side to null (unless already changed)
            if ($typeFrais->getIdTypeFrais() === $this) {
                $typeFrais->setIdTypeFrais(null);
            }
        }

        return $this;
    }
}
