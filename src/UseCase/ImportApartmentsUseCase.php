<?php
declare(strict_types=1);

namespace App\UseCase;


use App\Entity\Apartment;
use App\Repository\ApartmentRepository;

class ImportApartmentsUseCase implements ImportApartments
{
    /**
     * @var ApartmentRepository
     */
    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    public function execute(string $url): bool
    {
        $rawApartmentsData = file_get_contents($url);
        $apartments = $this->getApartmentsFromRawData($rawApartmentsData);

        return $this->apartmentRepository->save($apartments);
    }

    private function getApartmentsFromRawData(string $rawApartmentsData): array
    {
        $apartmentsXML = new \SimpleXMLElement($rawApartmentsData);

        $apartments = [];
        foreach ($apartmentsXML as $apartment) {
            $id = (int) $apartment->id;
            $title = (string) $apartment->title;
            $city = (string) $apartment->city;
            $link = (string) $apartment->url;
            $imgLink = (string) $apartment->pictures->picture[0]->picture_url;

            $apartments[] = Apartment::create($id, $title, $link, $city, $imgLink);
        }

        return $apartments;
    }
}