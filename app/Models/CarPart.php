<?php

namespace App\Models;

final readonly class CarPart
{
    public const int LOW_STOCK_THRESHOLD = 5;

    public function __construct(
        public int $id,
        public string $name,
        public string $code,
        public string $category,
        public string $manufacturer,
        public float $price,
        public int $stockQuantity,
        public bool $isAvailable,
    ) {}
}
