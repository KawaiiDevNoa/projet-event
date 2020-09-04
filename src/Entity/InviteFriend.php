<?php

namespace App\Entity;

use App\Repository\InviteFriendRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InviteFriendRepository::class)
 */
class InviteFriend
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Events::class, inversedBy="inviteFriends")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    public function __construct()
    {
        $this->email = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Events[]
     */
    public function getEmail(): Collection
    {
        return $this->email;
    }

    public function addEmail(Events $email): self
    {
        if (!$this->email->contains($email)) {
            $this->email[] = $email;
        }

        return $this;
    }

    public function removeEmail(Events $email): self
    {
        if ($this->email->contains($email)) {
            $this->email->removeElement($email);
        }

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
