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
    private $allFrais;

    public function __construct()
    {
        $this->allTypesFrais = new ArrayCollection();
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
    public function getAllFrais(): Collection
    {
        return $this->allFrais;
    }

    public function addTypeFrais(Frais $frais): self
    {
        if (!$this->allFrais->contains($frais)) {
            $this->allFrais[] = $frais;
            $frais->setIdTypeFrais($this);
        }

        return $this;
    }

    public function removeFrais(Frais $frais): self
    {
        if ($this->allFrais->contains($frais)) {
            $this->allFrais->removeElement($frais);
            // set the owning side to null (unless already changed)
            if ($frais->getIdTypeFrais() === $this) {
                $frais->setIdTypeFrais(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }

}
