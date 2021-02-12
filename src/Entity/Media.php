<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MediaRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imgSrc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Figure", inversedBy="images", cascade={"persist"})
     */
    private $figure;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $isFeaturedImage;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="image")
     */
    private $users;

    /**
     * @ORM\Column(name="is_image", type="boolean", nullable=true)
     */
    private $isImage;

    private $image;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return Int id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return String string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param String name
     * @return Media
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return String url
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param String url
     * @return Media
     */
    public function setUrl(string $url = null): self
    {
        $this->url = $url;

        return $this;
    }
   
    /**
     * @return Bool isImage
     */
    public function getIsImage(): ?bool
    {
        return $this->isImage;
    }

    /**
     * @param Bool isImage
     * @return Media
     */
    public function setIsImage(bool $isImage): self
    {
        $this->isImage = $isImage;

        return $this;
    }

    /**
     * @return File image
     */
    public function getImage(): ?File
    {
        return $this->image;
    }

    /**
     * @param File image
     * @return Media
     */
    public function setImage(?File $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Figure principalFigure
     */
    public function getPrincipalFigure(): ?Figure
    {
        return $this->principalFigure;
    }

    /**
     * @param Figure principalFigure
     * @return Media
     */
    public function setPrincipalFigure(?Figure $principalFigure): self
    {
        // unset the owning side of the relation if necessary
        if ($principalFigure === null && $this->principalFigure !== null) {
            $this->principalFigure->setFeaturedImage(null);
        }

        // set the owning side of the relation if necessary
        if ($principalFigure !== null && $principalFigure->getFeaturedImage() !== $this) {
            $principalFigure->setFeaturedImage($this);
        }

        $this->principalFigure = $principalFigure;

        return $this;
    }

    /**
     * @return Figure figure
     */
    public function getFigure(): ?Figure
    {
        return $this->figure;
    }

    /**
     * @param Figure figure
     * @return Media
     */
    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return Media 
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setImage($this);
        }

        return $this;
    }

    /**
     * @param User $user
     * @return Media 
     */
    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getImage() === $this) {
                $user->setImage(null);
            }
        }

        return $this;
    }

    /**
     * @return String ImgSrc
     */
    public function getImgSrc(): ?string
    {
        return $this->imgSrc;
    }

    /**
     * @param String $imgSrc
     * @return Media
     */
    public function setImgSrc(?string $imgSrc = null): self
    {
        $this->imgSrc = $imgSrc;

        return $this;
    }

    public function getIsFeaturedImage(): ?bool
    {
        return $this->isFeaturedImage;
    }

    public function setIsFeaturedImage(bool $isFeaturedImage): self
    {
        $this->isFeaturedImage = $isFeaturedImage;

        return $this;
    }
}
