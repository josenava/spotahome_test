<?php
declare(strict_types=1);

namespace App\Entity;


class Apartment implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $link;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $imgLink;

    private function __construct(int $id, string $title, string $link, string $city, string $imgLink)
    {
        $this->id = $id;
        $this->title = $title;
        $this->link = $link;
        $this->city = $city;
        $this->imgLink = $imgLink;
    }

    public static function fromArray(array $apartment): self
    {
        return new self(
            (int) $apartment['id'],
            $apartment['title'],
            $apartment['link'],
            $apartment['city'],
            $apartment['main_img_link']
        );
    }

    public static function create(int $id, string $title, string $link, string $city, string $imgLink): self
    {
        return new self($id, $title, $link, $city, $imgLink);
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return $this->link;
    }

    /**
     * @return string
     */
    public function city(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function imgLink(): string
    {
        return $this->imgLink;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'link' => $this->link,
            'city' => $this->city,
            'main_img_link' => $this->imgLink,
        ];
    }
}
