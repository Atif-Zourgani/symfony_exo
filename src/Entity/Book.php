<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 *  * //annotation qui permet de déclarer ma class en tant qu'entité (=tableau)
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // asser\length = permet d'intégrer les contraintes sur les formulaires php
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=100, minMessage="Le titre doit au moins comporter 2 caractères", maxMessage="Le titre ne doit pas comporter plus de 100 caractères")
     */
    private $title;

    //
    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="chaque livres doivent avoir au moins une page")
     */
    private $NBpages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice({"BD","manga","education","roman"})
     */
    private $style;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $InStock;

    // creation de relation de table dans BDD
    //many yo one = cardinalité de O a 1
    //quand c'est un manytoone il faut faire un inversed by pour lier les deux table
    //ensuite generer getteur et setteur et faire une doctrine migration
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="book")
     */
    private $authors;

    /**
     * @return mixed
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param mixed $authors
     */
    public function setAuthors($authors): void
    {
        $this->authors = $authors;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNBpages(): ?int
    {
        return $this->NBpages;
    }

    public function setNBpages(int $NBpages): self
    {
        $this->NBpages = $NBpages;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getInStock(): ?bool
    {
        return $this->InStock;
    }

    public function setInStock(bool $InStock): self
    {
        $this->InStock = $InStock;

        return $this;
    }
}
