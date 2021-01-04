<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

     /**
     * @ORM\OneToOne(targetEntity="App\Entity\Figure", mappedBy="featuredImage")
     */
    private $principalFigure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="images")
     */
    private $figure;

    /**
     * @ORM\Column(name="is_image", type="boolean", options={"default":true})
     */
    private $isImage;

    public function __construct()
    {
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getPrincipalFigures(): Collection
    {
        return $this->principalFigures;
    }

    public function addPrincipalFigure(Figure $principalFigure): self
    {
        if (!$this->principalFigures->contains($principalFigure)) {
            $this->principalFigures[] = $principalFigure;
            $principalFigure->setFetauredImage($this);
        }

        return $this;
    }

    public function removePrincipalFigure(Figure $principalFigure): self
    {
        if ($this->principalFigures->removeElement($principalFigure)) {
            // set the owning side to null (unless already changed)
            if ($principalFigure->getFetauredImage() === $this) {
                $principalFigure->setFetauredImage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    public function addFigure(Figure $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->addImage($this);
        }

        return $this;
    }

    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->removeElement($figure)) {
            $figure->removeImage($this);
        }

        return $this;
    }

    public function getPrincipalFigure(): ?Figure
    {
        return $this->principalFigure;
    }

    public function setPrincipalFigure(?Figure $principalFigure): self
    {
        // unset the owning side of the relation if necessary
        if ($principalFigure === null && $this->principalFigure !== null) {
            $this->principalFigure->setFetauredImage(null);
        }

        // set the owning side of the relation if necessary
        if ($principalFigure !== null && $principalFigure->getFetauredImage() !== $this) {
            $principalFigure->setFetauredImage($this);
        }

        $this->principalFigure = $principalFigure;

        return $this;
    }

    public function getFigure(): ?Figure
    {
        return $this->figure;
    }

    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;

        return $this;
    }

    public function getIsImage(): ?bool
    {
        return $this->isImage;
    }

    public function setIsImage(bool $isImage): self
    {
        $this->isImage = $isImage;

        return $this;
    }
}
