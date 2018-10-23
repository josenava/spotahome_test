<?php
declare(strict_types=1);

namespace App\UseCase;


use App\DTO\FilterParametersDTO;

interface GetApartments
{
    public function execute(FilterParametersDTO $filterParametersDTO): array;
}
