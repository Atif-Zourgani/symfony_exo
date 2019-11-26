<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * //annotation qui permet de déclarer ma class en tant qu'entité (=tableau)
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
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
    private $firstname;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $birhtDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $DeathDate;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $biography;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirhtDate(): ?int
    {
        return $this->birhtDate;
    }

    public function setBirhtDate(?int $birhtDate): self
    {
        $this->birhtDate = $birhtDate;

        return $this;
    }

    public function getDeathDate(): ?int
    {
        return $this->DeathDate;
    }

    public function setDeathDate(?int $DeathDate): self
    {
        $this->DeathDate = $DeathDate;

        return $this;
    }

    public function getBiography (): ?string
    {
        return $this->biography;
    }

    public function setBiography (?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
}
