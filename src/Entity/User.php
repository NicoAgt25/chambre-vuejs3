<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Chambre:item:get'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Chambre:item:get'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Chambre>
     */
    #[ORM\OneToMany(targetEntity: Chambre::class, mappedBy: 'affectation')]
    private Collection $chambres;

    #[ORM\OneToMany(targetEntity: Chambre::class, mappedBy: 'gouvernante')]
    private Collection $chambresgouvernante;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
        $this->createdAt=new \DateTimeImmutable();
        $this->updatedAt=new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): static
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres->add($chambre);
            $chambre->setAffectation($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): static
    {
        if ($this->chambres->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getAffectation() === $this) {
                $chambre->setAffectation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambresGouvernante(): Collection
    {
        return $this->chambresgouvernante;
    }

    public function addChambreGouvernante(Chambre $chambre): static
    {
        if (!$this->chambresgouvernante->contains($chambre)) {
            $this->chambresgouvernante->add($chambre);
            $chambre->setGouvernante($this);
        }

        return $this;
    }

    public function removeChambreGouvernante(Chambre $chambre): static
    {
        if ($this->chambresgouvernante->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getGouvernante() === $this) {
                $chambre->setGouvernante(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getPrenom().' '.$this->getNom();
    }
}
