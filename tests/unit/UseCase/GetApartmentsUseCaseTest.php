<?php
declare(strict_types=1);

namespace App\Tests\unit\UseCase;

use App\DTO\FilterParametersDTO;
use App\Exception\InvalidOrderSignException;
use App\Repository\ApartmentRepository;
use App\UseCase\GetApartmentsUseCase;
use PHPUnit\Framework\TestCase;

class GetApartmentsUseCaseTest extends TestCase
{
    public function testInvalidOrderSignIsThrown()
    {
        $this->expectException(InvalidOrderSignException::class);

        $apartmentRepositoryProphecy = $this->prophesize(ApartmentRepository::class);
        $apartmentRepository = $apartmentRepositoryProphecy->reveal();

        $useCase = new GetApartmentsUseCase($apartmentRepository);
        $filterDTO = new FilterParametersDTO('/wrongfield', 1, 1);

        $useCase->execute($filterDTO);
    }
}
