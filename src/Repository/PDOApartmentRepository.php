<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\Apartment;
use App\ValueObject\OrderBy;
use Doctrine\DBAL\Connection;

class PDOApartmentRepository implements ApartmentRepository
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function filter(OrderBy $orderBy, ?int $page, ?int $pageSize): array
    {
        $orderSql = $this->buildOrderSql($orderBy);
        $limitSql = $this->buildLimitSql($pageSize);

        $offsetSql = '';
        if (null !== $page && null !== $pageSize) {
            $offsetSql = 'OFFSET ' . ($page-1)*$pageSize;
        }

        $selectQuery = <<<SQL
SELECT id, title, city, link, main_img_link
FROM apartments $orderSql $limitSql $offsetSql
SQL;

        $apartments = $this->connection->fetchAll($selectQuery);

        return array_map(function(array $apartment) {
            return Apartment::fromArray($apartment);
        }, $apartments);
    }

    public function save(array $apartments): bool
    {
        foreach ($apartments as $apartment) {
            /** @var Apartment $apartment */
            $insertSql = <<<SQL
INSERT INTO apartments (id, title, city, link, main_img_link)
VALUES (?, ?, ?, ?, ?)
ON DUPLICATE KEY UPDATE
updated_at = NOW()
SQL;
            $this->connection->executeQuery($insertSql, [
                $apartment->id(),
                $apartment->title(),
                $apartment->city(),
                $apartment->link(),
                $apartment->imgLink()
            ]);
        }

        return true;
    }


    /**
     * @param OrderBy $orderBy
     * @return string
     */
    private function buildOrderSql(OrderBy $orderBy): string
    {
        $orderSql = '';
        if (null !== $orderBy->field()) {
            $orderSql = 'ORDER BY ' . $orderBy->field() . ' ' . $orderBy->order();
        }
        return $orderSql;
    }

    /**
     * @param int|null $pageSize
     * @return string
     */
    private function buildLimitSql(?int $pageSize): string
    {
        $limitSql = '';
        if (null !== $pageSize) {
            $limitSql = 'LIMIT ' . $pageSize;
        }
        return $limitSql;
    }
}