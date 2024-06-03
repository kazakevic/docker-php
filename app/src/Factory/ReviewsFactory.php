<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Review;
use App\Entity\ReviewStatus;

class ReviewsFactory
{
    public static function create(string $text): Review
    {
        $review = new Review();
        $review->setText($text);
        $review->setLocale('en_US');
        $review->setStatus(ReviewStatus::ACTIVE);
        $review->setRating('10');

        return $review;
    }
}
