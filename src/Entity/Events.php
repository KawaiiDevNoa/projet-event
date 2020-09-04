<?php

namespace App\Entity;

use App\Repository\EventsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventsRepository::class)
 */
class Events
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tri;

    /**
     * @ORM\ManyToMany(targetEntity=InviteFriend::class, mappedBy="email")
     */
    private $inviteFriends;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    public function __construct()
    {
        $this->inviteFriends = new ArrayCollection();
    }

    

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTri(): ?string
    {
        return $this->tri;
    }

    public function setTri(?string $tri): self
    {
        $this->tri = $tri;

        return $this;
    }

    /**
     * @return Collection|InviteFriend[]
     */
    public function getInviteFriends(): Collection
    {
        return $this->inviteFriends;
    }

    public function addInviteFriend(InviteFriend $inviteFriend): self
    {
        if (!$this->inviteFriends->contains($inviteFriend)) {
            $this->inviteFriends[] = $inviteFriend;
            $inviteFriend->addEmail($this);
        }

        return $this;
    }

    public function removeInviteFriend(InviteFriend $inviteFriend): self
    {
        if ($this->inviteFriends->contains($inviteFriend)) {
            $this->inviteFriends->removeElement($inviteFriend);
            $inviteFriend->removeEmail($this);
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

   
    
    

  
}
