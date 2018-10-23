<?php
declare(strict_types=1);

namespace App\Controller;


use App\DTO\FilterParametersDTO;
use App\UseCase\GetApartments;
use App\UseCase\GetApartmentsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApartmentController extends Controller
{
    private const FILE_FORMAT = 'json_file';
    private const FILE_NAME = 'apartments.json';

    /**
     * @var GetApartmentsUseCase
     */
    private $getApartmentsUseCase;

    public function __construct(GetApartments $getApartmentsUseCase)
    {
        $this->getApartmentsUseCase = $getApartmentsUseCase;
    }

    public function getAction(Request $request): Response
    {
        $pageNumber = $request->query->getInt('page');
        $pageSize = $request->query->getInt('page_size');
        $orderBy = $request->query->get('orderBy');
        $format = $request->query->get('format');

        $filterParameters = new FilterParametersDTO($orderBy, $pageNumber, $pageSize);
        $apartments = $this->getApartmentsUseCase->execute($filterParameters);

        if (self::FILE_FORMAT === $format) {
            $this->createFileFromJsonData(json_encode($apartments));

            return $this->file(new File(self::FILE_NAME));
        }

        return $this->json($apartments);
    }

    private function createFileFromJsonData(string $jsonData): void
    {
        $file = fopen(self::FILE_NAME, 'w');
        fwrite($file, $jsonData);
        fclose($file);
    }
}