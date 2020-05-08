<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tirage", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tirage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $uniqueId;

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

    public function getTirage(): ?Tirage
    {
        return $this->tirage;
    }

    public function setTirage(?Tirage $tirage): self
    {
        $this->tirage = $tirage;

        return $this;
    }

    public function getUniqueId(): ?string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(?string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    public static function isCreator(Tirage $tirage, string $uniqueId = null)
    {
        $creator = $tirage->getCreator();

        if (!$creator instanceof Participant || $uniqueId === null)
            return false;

        return $creator->getUniqueId() === $uniqueId;
    }
}
