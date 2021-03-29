<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $enCours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Valider;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class, inversedBy="commandes")
     */
    private $produts;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
    private $user;

    public function __construct()
    {
        $this->produts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnCours(): ?string
    {
        return $this->enCours;
    }

    public function setEnCours(string $enCours): self
    {
        $this->enCours = $enCours;

        return $this;
    }

    public function getValider(): ?string
    {
        return $this->Valider;
    }

    public function setValider(?string $Valider): self
    {
        $this->Valider = $Valider;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduts(): Collection
    {
        return $this->produts;
    }

    public function addProdut(Produit $produt): self
    {
        if (!$this->produts->contains($produt)) {
            $this->produts[] = $produt;
        }

        return $this;
    }

    public function removeProdut(Produit $produt): self
    {
        $this->produts->removeElement($produt);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

// ORM\Entity(repositoryClass=CommandeRepository::class)= explique à doctrine que ma class Commande qui correspond au selection à mon reposity CommandeRepository.
// Ma class contient des champs(attributs) qui ont été classé en privé 
// vu que mes champs sont en privée ma commande à générer automatiquement les méthode get et set 