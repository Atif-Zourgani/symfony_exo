<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * //annotation qui permet de déclarer ma class en tant qu'entité (=tableau)
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 * @ORM\Table(name="author")
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birhtDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DeathDate;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $biography;

    // creation de relation de table dans BDD
    //many yo one = cardinalité de 1 a 0
    //quand on fait un onetomany il faut faire un mappedby pour lier les deux tables
    //ensuite generer getteur et setteur et faire une doctrine migration
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="authors")
     */
    private $book;

    //cette construct sert a construire un array pour stocker tout les book ( pour eviter quils s'écrasent les uns les autres )
    public function __construct()
    {
        $this->book = new ArrayCollection();
    }


    public function getBook()
    {
        return $this->book;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getBirhtDate(): ?\DateTime
    {
        return $this->birhtDate;
    }

    public function setBirhtDate(?\DateTime $birhtDate): self
    {
        $this->birhtDate = $birhtDate;

        return $this;
    }

    public function getDeathDate(): ?\DateTime
    {
        return $this->DeathDate;
    }

    public function setDeathDate(?\DateTime $DeathDate): self
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
