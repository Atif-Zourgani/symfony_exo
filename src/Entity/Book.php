<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $NBpages;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $style;

    /**
     * @ORM\Column(type="boolean")
     */
    private $InStock;

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
