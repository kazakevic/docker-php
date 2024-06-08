<?php

declare(strict_types=1);

namespace App\Property\Entity;

use App\Price\Entity\Price;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'hotels')]
 class Hotel
{
    #[ORM\Id()]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column(type: 'string')]
    private ?string $title = null;
    #[ORM\Column(type: 'text')]
    private ?string $description = null;
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\OneToMany(targetEntity: Room::class, mappedBy: 'hotel', cascade: ['persist'], orphanRemoval: true)]
    /** Collection<int, Room> */
    private Collection $rooms;
    #[ORM\OneToOne(targetEntity: Price::class, cascade: ['persist'], orphanRemoval: true)]
    private Price $price;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function setRooms(Collection $rooms): void
    {
        $this->rooms = $rooms;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function setPrice(Price $price): void
    {
        $this->price = $price;
    }
}
