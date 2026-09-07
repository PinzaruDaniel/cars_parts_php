<?php

namespace App\Models;

final readonly class CarPart
{
    public const int LOW_STOCK_THRESHOLD = 5;

    public const float DISCOUNT_PERCENT = 10.0;

    public function __construct(
        public int    $id,
        public string $name,
        public string $code,
        public string $category,
        public string $manufacturer,
        public float  $price,
        public int    $stockQuantity,
        public bool   $isAvailable,
    )
    {
    }

    public function discountAmount(): float
    {
        return $this->price * self::DISCOUNT_PERCENT / 100;
    }

    public function priceAfterDiscount(): float
    {
        return $this->price - $this->discountAmount();
    }

    public function stockValueBeforeDiscount(): float
    {
        return $this->stockQuantity * $this->price;
    }

    public function stockValueAfterDiscount(): float
    {
        return $this->priceAfterDiscount() * $this->stockQuantity;
    }
}
