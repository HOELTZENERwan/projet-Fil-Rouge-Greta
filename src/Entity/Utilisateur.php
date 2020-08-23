<?php

namespace App\Entity;

use App\Entity\Frais;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @Vich\Uploadable
 * @ApiResource
 * @UniqueEntity(fields= {"email"},
 * message= "Cette adresse email est déjà enregistrée")
 */
class Utilisateur implements UserInterface, EquatableInterface
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

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="addedBy")
     */
    private $clients;
    

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $contract;

    /**
     * @Vich\UploadableField(mapping="user_contracts", fileNameProperty="contract")
     * @var File
     */
    private $contractFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locale;

    public function __construct()
    {
        $this->fraisAll = new ArrayCollection();
        $this->clients = new ArrayCollection();
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

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(string $contract): self
    {
        $this->contract = $contract;
    }

    public function getContractFile(): ?File
    {
        return $this->contractFile;
    }

    public function setContractFile(File $contractFile)
    {
        $this->contractFile = $contractFile;
        
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
            // $this->passw = null;
        }


    /**
     * @see UserInterface
     */
    public function getSalt(): ?string {
        //pas besoin si on utilise l'algo bcrypt sur security.yaml
        return null;
    }


    /**
     * @return Collection|Client[]
     * 
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setAddedBy($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getAddedBy() === $this) {
                $client->setAddedBy(null);
            }
        }

        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function __toString()
    {
        return $this->prenom.' '.$this->nom;
    }

    public function isEqualTo(UserInterface $user)
    {
        if($user instanceof self)
        {
            if($user->getLocale() != $this->locale) 
            {
                return false;
            }
        }

        return true;
    }

    public function isAdmin(UserInterface $user)
    {
        if(in_array('ROLE_ADMIN',$user->getRoles()) || in_array('ROLE_SUPER_ADMIN',$user->getRoles())){
            return true;
        }
    }
}
