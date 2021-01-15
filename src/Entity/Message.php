<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="text", length=65535)
    * @Assert\Length(
    *     max=65535,
    *     maxMessage="Votre message"
    * )
    */
    private $content;

    /**
     * @ORM\Column(type="date")
     */
    private $addAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     */
    private $user;

    /**
     * @return Int id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return String content
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param String content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return DateTimeInterface addAt
     */
    public function getAddAt(): ?\DateTimeInterface
    {
        return $this->addAt;
    }

    /**
     * @param DateTimeInterface addAt
     * @return Message
     */
    public function setAddAt(\DateTimeInterface $addAt): self
    {
        $this->addAt = $addAt;

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
     * @return Message
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
