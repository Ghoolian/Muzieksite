<?php

namespace App\Entity;

use App\Repository\ArtiestenRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtiestenRepository::class)
 */
class Artiesten
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
     * @ORM\Column(type="string", length=255)
     */
    private $Achternaam;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Muziekstijl;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Geboortedatum;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Beschrijving;

    /**
     * @ORM\OneToMany(targetEntity=Albums::class, mappedBy="ArtiestenID")
     */
    private $AlbumCollectie;

    public function __construct()
    {
        $this->AlbumCollectie = new ArrayCollection();
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

    public function getAchternaam(): ?string
    {
        return $this->Achternaam;
    }

    public function setAchternaam(string $Achternaam): self
    {
        $this->Achternaam = $Achternaam;

        return $this;
    }

    public function getMuziekstijl(): ?string
    {
        return $this->Muziekstijl;
    }

    public function setMuziekstijl(?string $Muziekstijl): self
    {
        $this->Muziekstijl = $Muziekstijl;

        return $this;
    }

    public function getGeboortedatum(): ?DateTimeInterface
    {
        return $this->Geboortedatum;
    }

    public function setGeboortedatum(?DateTimeInterface $Geboortedatum): self
    {
        $this->Geboortedatum = $Geboortedatum;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->Beschrijving;
    }

    public function setBeschrijving(?string $Beschrijving): self
    {
        $this->Beschrijving = $Beschrijving;

        return $this;
    }

    /**
     * @return Collection|Albums[]
     */
    public function getAlbumCollectie(): Collection
    {
        return $this->AlbumCollectie;
    }

    public function addAlbumCollectie(Albums $albumCollectie): self
    {
        if (!$this->AlbumCollectie->contains($albumCollectie)) {
            $this->AlbumCollectie[] = $albumCollectie;
            $albumCollectie->setArtiestenID($this);
        }

        return $this;
    }

    public function removeAlbumCollectie(Albums $albumCollectie): self
    {
        if ($this->AlbumCollectie->contains($albumCollectie)) {
            $this->AlbumCollectie->removeElement($albumCollectie);
            // set the owning side to null (unless already changed)
            if ($albumCollectie->getArtiestenID() === $this) {
                $albumCollectie->setArtiestenID(null);
            }
        }

        return $this;
    }


}
