<?php

namespace App\Entity;

use App\Repository\AlbumsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumsRepository::class)
 */
class Albums
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
    private $Naam;

    /**
     * @ORM\OneToMany(targetEntity=Nummers::class, mappedBy="AlbumID")
     */
    private $NummerCollectie;

    /**
     * @ORM\ManyToOne(targetEntity=Artiesten::class, inversedBy="AlbumCollectie")
     */
    private $ArtiestenID;

    public function __construct()
    {
        $this->NummerCollectie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->Naam;
    }

    public function setNaam(string $Naam): self
    {
        $this->Naam = $Naam;

        return $this;
    }

    /**
     * @return Collection|Nummers[]
     */
    public function getNummerCollectie(): Collection
    {
        return $this->NummerCollectie;
    }

    public function addNummerCollectie(Nummers $nummerCollectie): self
    {
        if (!$this->NummerCollectie->contains($nummerCollectie)) {
            $this->NummerCollectie[] = $nummerCollectie;
            $nummerCollectie->setAlbumID($this);
        }

        return $this;
    }

    public function removeNummerCollectie(Nummers $nummerCollectie): self
    {
        if ($this->NummerCollectie->contains($nummerCollectie)) {
            $this->NummerCollectie->removeElement($nummerCollectie);
            // set the owning side to null (unless already changed)
            if ($nummerCollectie->getAlbumID() === $this) {
                $nummerCollectie->setAlbumID(null);
            }
        }

        return $this;
    }

    public function getArtiestenID(): ?Artiesten
    {
        return $this->ArtiestenID;
    }

    public function setArtiestenID(?Artiesten $ArtiestenID): self
    {
        $this->ArtiestenID = $ArtiestenID;

        return $this;
    }


}
