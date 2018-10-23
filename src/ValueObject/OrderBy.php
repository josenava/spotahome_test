<?php
declare(strict_types=1);

namespace App\ValueObject;


use App\Exception\InvalidOrderSignException;

final class OrderBy
{
    private const ORDER = [
        '+' => 'ASC',
        '-' => 'DESC'
    ];

    /**
     * @var null|string
     */
    private $field;
    /**
     * @var null|string
     */
    private $order;

    private function __construct(?string $field, ?string $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    public static function create(?string $orderBy): self
    {
        if (null !== $orderBy) {
            $order = self::convertToOrder($orderBy);
            $field = substr($orderBy, 1);

            return new self($field, $order);
        }

        return new self(null, null);
    }

    /**
     * @return null|string
     */
    public function field(): ?string
    {
        return $this->field;
    }

    /**
     * @return null|string
     */
    public function order(): ?string
    {
        return $this->order;
    }

    private static function convertToOrder(string $orderBy): string
    {
        if (strlen($orderBy) > 1 && !array_key_exists($orderBy[0], self::ORDER)) {
            throw new InvalidOrderSignException(sprintf('Invalid order sign in %s', $orderBy));
        }

        return self::ORDER[$orderBy[0]];
    }
}