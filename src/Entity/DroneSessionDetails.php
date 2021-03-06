<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DroneSessionDetailsRepository")
 */
class DroneSessionDetails
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $speed;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $distance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DroneSession", inversedBy="details")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): self
    {
        $this->distance = $distance;

        return $this;
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

    public function getSession(): ?DroneSession
    {
        return $this->session;
    }

    public function setSession(?DroneSession $session): self
    {
        $this->session = $session;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'speed' => $this->speed,
            'distance' => $this->distance,
            'createdAt' => $this->createdAt,
            'sessionId' => $this->getSession() instanceof DroneSession ? $this->getSession()->getId() : -1
        ];
    }

    public static function fromArray(array $data, DroneSession $session)
    {
        return (new DroneSessionDetails())
            ->setSpeed($data['speed'] ?? -1)
            ->setDistance($data['distance'] ?? -1)
            ->setCreatedAt($data['createdAt'] ?? new \DateTime())
            ->setSession($session);
    }
}
