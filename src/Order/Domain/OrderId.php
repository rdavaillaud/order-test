<?php

declare(strict_types=1);

namespace App\Order\Domain;

class OrderId
{
    /**
     * @var int
     */
    private $id;

    private function __construct(int $id)
    {
        $this->id = $id;
    }

    public static function fromInt(int $id): self
    {
        return new self($id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return strval($this->id);
    }
}
