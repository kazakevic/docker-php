<?php

namespace App\Property\Factory;

use App\Price\Factory\PriceFactory;
use App\Property\Entity\Hotel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class HotelFactory
{
    public static function create(): Hotel
    {
        $roomsCount = range(1, random_int(1, 10));

        $rooms = new ArrayCollection();

        foreach ($roomsCount as $roomCreateIteration) {
            $rooms->add(RoomFactory::create());
        }

        $hotel = new Hotel();
        $hotel->setDescription('Hotel number: ' . Uuid::v7()->toString() . ' description');
        $hotel->setTitle('Hotel number: ' . Uuid::v7()->toString());
        $hotel->setRooms($rooms);
        $hotel->setPrice(PriceFactory::create());
        $hotel->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('UTC')));
        return $hotel;
    }
}