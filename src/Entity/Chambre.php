<?php

namespace App\Entity;

use DateTimeImmutable;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChambreRepository;
use ApiPlatform\Metadata\GetCollection;


#[ORM\Entity(repositoryClass: ChambreRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'Chambre:item:get'],),
        new GetCollection(),
        new Post(),
        new Delete(),
        new Patch()
    ]
)]
class Chambre
{  
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['Chambre:item:get'])]
    private ?int $numero = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Chambre:item:get'])]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['Chambre:item:get'])]
    private ?int $nbPersonne = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['Chambre:item:get'])]
    private ?string $suiviMenage = null;

    #[ORM\Column]
    #[Groups(['Chambre:item:get'])]
    private ?bool $isValidate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['Chambre:item:get'])]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['Chambre:item:get'])]
    private ?string $statut = null;

    #[ORM\Column]
    #[Groups(['Chambre:item:get'])]
    private ?DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['Chambre:item:get'])]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'chambres')]
    private ?User $affectation = null;

    #[ORM\ManyToOne(inversedBy: 'chambres')]
    private ?User $gouvernante = null;

    public function __construct()
    {
         $this->createdAt=new \DateTimeImmutable();
         $this->updatedAt=new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
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

    public function getNbPersonne(): ?int
    {
        return $this->nbPersonne;
    }

    public function setNbPersonne(?int $nbPersonne): static
    {
        $this->nbPersonne = $nbPersonne;

        return $this;
    }

    public function getSuiviMenage(): ?string
    {
        return $this->suiviMenage;
    }

    public function setSuiviMenage(?string $suiviMenage): static
    {
        $this->suiviMenage = $suiviMenage;

        return $this;
    }

    public function isValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setValidate(bool $isValidate): static
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

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

    public function getAffectation(): ?User
    {
        return $this->affectation;
    }

    public function setAffectation(?User $affectation): static
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getGouvernante(): ?User
    {
        return $this->gouvernante;
    }

    public function setGouvernante(?User $gouvernante): static
    {
        $this->gouvernante = $gouvernante;

        return $this;
    }
}
