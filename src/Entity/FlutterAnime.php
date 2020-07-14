<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FlutterAnimeRepository")
 */
class FlutterAnime
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
    private $malId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMalId(): ?string
    {
        return $this->malId;
    }

    public function setMalId(string $malId): self
    {
        $this->malId = $malId;

        return $this;
    }

    public function getRank(): ?string
    {
        return $this->rank;
    }

    public function setRank(string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public static function fromArray(array $data)
    {
        return (new FlutterAnime())
            ->setType($data['type'] ?? "")
            ->setRank($data['rank'] ?? "")
            ->setTitle($data['title'] ?? "")
            ->setMalId($data['mal_id'] ?? "")
            ->setImageUrl($data['image_url'] ?? "");
    }

    public function toArray()
    {
        return [
            'type' => $this->type,
            'rank' => $this->rank,
            'title' => $this->title,
            'mal_id' => $this->malId,
            'image_url' => $this->imageUrl
        ];
    }
}
