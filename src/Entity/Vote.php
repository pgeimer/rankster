<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 * @ORM\Table(uniqueConstraints={
 *     @ORM\UniqueConstraint(name="unique_voter", columns={"user_id", "post_id"})})
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;


    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
