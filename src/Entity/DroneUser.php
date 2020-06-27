<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DroneUserRepository")
 * @UniqueEntity(
 *     fields={"email", "pseudo"},
 *     message="This email or pseudo is already in use on app."
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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $password;

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
}
