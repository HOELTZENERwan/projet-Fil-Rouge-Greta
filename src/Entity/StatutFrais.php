<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\StatutFraisRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StatutFraisRepository::class)
 */
class StatutFrais
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity=Frais::class, mappedBy="idStatutFrais")
     */
    private $fraisCollection;

    public function __construct()
    {
        $this->fraisCollection = new ArrayCollection();
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
    public function getFraisCollection(): Collection
    {
        return $this->fraisCollection;
    }

    public function addFrais(Frais $frais): self
    {
        if (!$this->fraisCollection->contains($frais)) {
            $this->fraisCollection[] = $frais;
            $fraisCollection->setIdStatutFrais($this);
        }

        return $this;
    }

    public function removeFrais(Frais $frais): self
    {
        if ($this->fraisCollection->contains($frais)) {
            $this->fraisCollection->removeElement($frais);
            // set the owning side to null (unless already changed)
            if ($frais->getIdStatutFrais() === $this) {
                $frais->setIdStatutFrais(null);
            }
        }

        return $this;
    }
}