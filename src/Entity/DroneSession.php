<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DroneSessionRepository")
 */
class DroneSession
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DroneSessionDetails", mappedBy="session")
     */
    private $details;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DroneUser", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->details = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|DroneSessionDetails[]
     */
    public function getDetails(): Collection
    {
        return $this->details;
    }

    public function addDetail(DroneSessionDetails $detail): self
    {
        if (!$this->details->contains($detail)) {
            $this->details[] = $detail;
            $detail->setSession($this);
        }

        return $this;
    }

    public function removeDetail(DroneSessionDetails $detail): self
    {
        if ($this->details->contains($detail)) {
            $this->details->removeElement($detail);
            // set the owning side to null (unless already changed)
            if ($detail->getSession() === $this) {
                $detail->setSession(null);
            }
        }

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt
        ];
    }

    public static function fromArray(array $data)
    {
        return (new DroneSession())
            ->setCreatedAt($data['createdAt'] ?? new \DateTime());
    }

    public function getUser(): ?DroneUser
    {
        return $this->user;
    }

    public function setUser(?DroneUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}
