<?php

namespace App\Price\Factory;

use App\Price\Entity\Price;

class PriceFactory
{
    public static function create(): Price
    {
        $price = new Price();
        $price->setAmount(self::getRandomPrice());
        return $price;
    }

    private static function getRandomPrice(): int
    {
        $prices = [10000, 20000, 30000, 80000, 15000];


        return array_rand($prices);
    }
}