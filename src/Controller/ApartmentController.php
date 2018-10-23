<?php
declare(strict_types=1);

namespace App\Controller;


use App\DTO\FilterParametersDTO;
use App\UseCase\GetApartments;
use App\UseCase\GetApartmentsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApartmentController extends Controller
{
    /**
     * @var GetApartmentsUseCase
     */
    private $getApartmentsUseCase;

    public function __construct(GetApartments $getApartmentsUseCase)
    {
        $this->getApartmentsUseCase = $getApartmentsUseCase;
    }

    public function getAction(Request $request): JsonResponse
    {
        $pageNumber = $request->query->getInt('page');
        $pageSize = $request->query->getInt('page_size');
        $orderBy = $request->query->get('orderBy');

        $filterParameters = new FilterParametersDTO($orderBy, $pageNumber, $pageSize);

        return $this->json($this->getApartmentsUseCase->execute($filterParameters));
    }
}