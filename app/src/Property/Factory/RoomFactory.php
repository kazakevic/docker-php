<?php

namespace App\Property\Factory;

use App\Property\Entity\Hotel;
use App\Property\Entity\Room;
use Random\RandomException;

class RoomFactory
{
    /**
     * @throws RandomException
     */
    public static function create(): Room
    {
        $room = new Room();
        $room->setName(self::getRandomName());
        $room->setSize((string) self::getRandomSize());
        return $room;
    }

    /**
     * @throws RandomException
     */
    private static function getRandomName(): string
    {
        return bin2hex(random_bytes(8));
    }

    /**
     * @throws RandomException
     */
    private static function getRandomSize(): int
    {
        return mt_rand() / mt_getrandmax();
    }
}