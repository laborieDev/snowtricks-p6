<?php

namespace App\Entity;

use App\Repository\FigureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FigureRepository::class)
 */
class Figure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
    * @Gedmo\Slug(fields={"name"}, style="camel", separator="_")
    * @ORM\Column(length=128, unique=true, nullable=true)
    */
    private $slug;

    /**
    * @ORM\Column(type="text", length=65535)
    * @Assert\Length(
    *     max=65535,
    *     maxMessage="La description"
    * )
    */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Group", inversedBy="figures", cascade={"persist"})
     */
    private $group;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Media", inversedBy="principalFigure", cascade={"persist"})
     */
    private $featuredImage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="figure", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="figures")
     */
    private $user;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return Int id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return String name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param String name
     * @return Figure
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return String description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param String description
     * @return Figure
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return String slug
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param String param
     * @return Figure
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Media
     */
    public function getFeaturedImage(): ?Media
    {
        return $this->featuredImage;
    }

    /**
     * @param Media featuredImage
     */
    public function setFeaturedImage(?Media $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Media image
     * @return Figure
     */
    public function addImage(Media $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setFigure($this);

        }

        return $this;
    }

    /**
     * @param Media image
     * @return Figure
     */
    public function removeImage(Media $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getFigure() === $this) {
                $image->setFigure(null);
            }
        }

        return $this;
    }

    /**
     * @return Group group
     */
    public function getGroup(): ?Group
    {
        return $this->group;
    }

    /**
     * @param Group group
     * @return Figure
     */
    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        return $this;
    }

    /**
     * @return User user
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User user
     * @return Figure
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
