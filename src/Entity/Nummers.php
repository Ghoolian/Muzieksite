<?php

namespace App\Entity;

use App\Repository\NummersRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NummersRepository::class)
 */
class Nummers
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
     * @ORM\Column(type="date")
     */
    private $Jaar;

    /**
     * @ORM\ManyToOne(targetEntity=Albums::class, inversedBy="NummerCollectie")
     */
    private $AlbumID;

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

    public function getJaar(): ?DateTimeInterface
    {
        return $this->Jaar;
    }

    public function setJaar(DateTimeInterface $Jaar): self
    {
        $this->Jaar = $Jaar;

        return $this;
    }

    public function getAlbumID(): ?Albums
    {
        return $this->AlbumID;
    }

    public function setAlbumID(?Albums $AlbumID): self
    {
        $this->AlbumID = $AlbumID;

        return $this;
    }

}
