<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="app_group")
 */
class Group
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
     * @ORM\OneToMany(targetEntity="App\Entity\Figure", mappedBy="group", cascade={"persist"})
     */
    private $figures;

    public function __construct()
    {
        $this->figures = new ArrayCollection();
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
     * @return Group
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Figure[]
     */
    public function getFigures(): Collection
    {
        return $this->figures;
    }

    /**
     * @param Figure figure
     * @return Group
     */
    public function addFigure(Figure $figure): self
    {
        if (!$this->figures->contains($figure)) {
            $this->figures[] = $figure;
            $figure->setGroup($this);
        }

        return $this;
    }

    /**
     * @param Figure figure
     * @return Group
     */
    public function removeFigure(Figure $figure): self
    {
        if ($this->figures->removeElement($figure)) {
            // set the owning side to null (unless already changed)
            if ($figure->getGroup() === $this) {
                $figure->setGroup(null);
            }
        }

        return $this;
    }
}
