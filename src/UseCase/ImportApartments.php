<?php
declare(strict_types=1);

namespace App\UseCase;


interface ImportApartments
{
    public function execute(string $url): bool;
}