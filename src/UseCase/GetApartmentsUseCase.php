<?php
declare(strict_types=1);

namespace App\UseCase;


use App\DTO\FilterParametersDTO;
use App\Repository\PDOApartmentRepository;
use App\ValueObject\OrderBy;

class GetApartmentsUseCase implements GetApartments
{
    /**
     * @var PDOApartmentRepository
     */
    private $apartmentRepository;

    public function __construct(PDOApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function execute(FilterParametersDTO $filterParametersDTO): array
    {
        $orderBy = OrderBy::create($filterParametersDTO->getOrderBy());

        return $this->apartmentRepository->filter(
            $orderBy,
            $filterParametersDTO->getPageNumber(),
            $filterParametersDTO->getPageSize()
        );
    }
}