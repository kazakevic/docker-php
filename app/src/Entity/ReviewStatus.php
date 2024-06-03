<?php

declare(strict_types=1);

namespace App\Entity;

enum ReviewStatus: string
{
    case ACTIVE = 'active';
    case BLOCKED = 'blocked';
    case DELETED = 'deleted';
}
