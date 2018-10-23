<?php
declare(strict_types=1);

namespace App\Repository;


use App\ValueObject\OrderBy;

interface ApartmentRepository
{
    public function filter(OrderBy $orderBy, ?int $page, ?int $pageSize): array;
    public function save(array $apartments): bool;
}