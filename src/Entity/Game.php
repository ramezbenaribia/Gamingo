<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $desccription;


    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $trailer;

    /**
     * @ORM\Column(type="text")
     */
    private $text1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text3;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre1;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titre3;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text4;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $titre4;

    /**
     * @ORM\ManyToMany(targetEntity=Console::class, inversedBy="games")
     */
    private $console;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Engine;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $license;

    public function __construct()
    {
        $this->console = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDesccription(): ?string
    {
        return $this->desccription;
    }

    public function setDesccription(string $desccription): self
    {
        $this->desccription = $desccription;

        return $this;
    }



    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getTrailer(): ?string
    {
        return $this->trailer;
    }

    public function setTrailer(string $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function getText1(): ?string
    {
        return $this->text1;
    }

    public function setText1(string $text1): self
    {
        $this->text1 = $text1;

        return $this;
    }

    public function getText2(): ?string
    {
        return $this->text2;
    }

    public function setText2(?string $text2): self
    {
        $this->text2 = $text2;

        return $this;
    }

    public function getText3(): ?string
    {
        return $this->text3;
    }

    public function setText3(?string $text3): self
    {
        $this->text3 = $text3;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getTitre1(): ?string
    {
        return $this->titre1;
    }

    public function setTitre1(string $titre1): self
    {
        $this->titre1 = $titre1;

        return $this;
    }

    public function getTitre2(): ?string
    {
        return $this->titre2;
    }

    public function setTitre2(string $titre2): self
    {
        $this->titre2 = $titre2;

        return $this;
    }

    public function getTitre3(): ?string
    {
        return $this->titre3;
    }

    public function setTitre3(?string $titre3): self
    {
        $this->titre3 = $titre3;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getText4(): ?string
    {
        return $this->text4;
    }

    public function setText4(?string $text4): self
    {
        $this->text4 = $text4;

        return $this;
    }

    public function getTitre4(): ?string
    {
        return $this->titre4;
    }

    public function setTitre4(?string $titre4): self
    {
        $this->titre4 = $titre4;

        return $this;
    }

    /**
     * @return Collection|Console[]
     */
    public function getConsole(): Collection
    {
        return $this->console;
    }

    public function addConsole(Console $console): self
    {
        if (!$this->console->contains($console)) {
            $this->console[] = $console;
        }

        return $this;
    }

    public function removeConsole(Console $console): self
    {
        if ($this->console->contains($console)) {
            $this->console->removeElement($console);
        }

        return $this;
    }

    public function getEngine(): ?string
    {
        return $this->Engine;
    }

    public function setEngine(?string $Engine): self
    {
        $this->Engine = $Engine;

        return $this;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function setLicense(?string $license): self
    {
        $this->license = $license;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}