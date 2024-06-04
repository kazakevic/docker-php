<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ORM\Table(name: '`reviews`')]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    private ?string $text = null;

    #[ORM\Column(type: 'string', length: 10)]
    private ?string $locale = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2 )]
    private ?string $rating = '0';

    #[ORM\Column(type: 'string', enumType: ReviewStatus::class)]
    private ?ReviewStatus $status = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $tags = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    public function getRating(): ?string
    {
        return $this->rating;
    }

    public function setRating(?string $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function getStatus(): ?ReviewStatus
    {
        return $this->status;
    }

    public function setStatus(?ReviewStatus $category): self
    {
        $this->status = $category;
        return $this;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /** @param $tags array<int, string> */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /** @return null|array<int, string> */
    public function getTags(): ?array
    {
        return $this->tags;
    }
}
