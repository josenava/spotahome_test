<?php
declare(strict_types=1);

namespace App\DTO;


final class FilterParametersDTO
{
    /**
     * @var null|string
     */
    private $orderBy;
    /**
     * @var int|null
     */
    private $pageNumber;
    /**
     * @var int|null
     */
    private $pageSize;

    /**
     * FilterParametersDTO constructor.
     * @param null|string $orderBy
     * @param int|null $pageNumber
     * @param int|null $pageSize
     */
    public function __construct(?string $orderBy, ?int $pageNumber, ?int $pageSize)
    {
        $this->orderBy = $orderBy;
        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
    }

    /**
     * @return int
     */
    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    /**
     * @return int
     */
    public function getPageNumber(): int
    {
        return $this->pageNumber;
    }

    /**
     * @return string
     */
    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }
}
