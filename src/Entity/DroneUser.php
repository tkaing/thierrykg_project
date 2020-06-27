<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DroneUserRepository")
 * @UniqueEntity(
 *     fields="email",
 *     message="{{ value }} already in use on app."
 * )
 * @UniqueEntity(
 *     fields="pseudo",
 *     message="{{ value }} already in use on app."
 * )
 */
class DroneUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank()
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DroneSession", mappedBy="user")
     */
    private $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'pseudo' => $this->pseudo,
            'password' => $this->password
        ];
    }

    public static function fromArray(array $data)
    {
        return (new DroneUser())
            ->setEmail($data['email'] ?? "")
            ->setPseudo($data['pseudo'] ?? "")
            ->setPassword($data['password'] ?? "");
    }

    /**
     * @return Collection|DroneSession[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSessions(DroneSession $sessions): self
    {
        if (!$this->sessions->contains($sessiosn)) {
            $this->sessions[] = $sessiosn;
            $sessiosn->setUser($this);
        }

        return $this;
    }

    public function removeSessions(DroneSession $sessions): self
    {
        if ($this->sessions->contains($sessions)) {
            $this->sessions->removeElement($sessions);
            // set the owning side to null (unless already changed)
            if ($sessions->getUser() === $this) {
                $sessions->setUser(null);
            }
        }

        return $this;
    }
}
