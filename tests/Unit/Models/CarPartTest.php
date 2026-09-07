<?php

namespace Tests\Unit\Models;

use App\Models\CarPart;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CarPartTest extends TestCase
{
    /**
     * @param  array{discount: float, priceAfterDiscount: float, stockBeforeDiscount: float, stockAfterDiscount: float}  $expectedResults
     */
    #[DataProvider('carPartScenarios')]
    public function test_calculations_return_expected_results(
        float $price,
        int $stockQuantity,
        array $expectedResults,
    ): void {
        $carPart = new CarPart(
            id: 1,
            name: 'Piesă de test',
            code: 'TEST-001',
            category: 'Test',
            manufacturer: 'Test',
            price: $price,
            stockQuantity: $stockQuantity,
            isAvailable: $stockQuantity > 0,
        );

        $this->assertSame($expectedResults['discount'], round($carPart->discountAmount(), 2));
        $this->assertSame($expectedResults['priceAfterDiscount'], round($carPart->priceAfterDiscount(), 2));
        $this->assertSame($expectedResults['stockBeforeDiscount'], round($carPart->stockValueBeforeDiscount(), 2));
        $this->assertSame($expectedResults['stockAfterDiscount'], round($carPart->stockValueAfterDiscount(), 2));
    }

    /**
     * @return array<string, array{float, int, array{discount: float, priceAfterDiscount: float, stockBeforeDiscount: float, stockAfterDiscount: float}}>
     */
    public static function carPartScenarios(): array
    {
        return [
            'stoc obișnuit' => [849.99, 12, [
                'discount' => 85.00,
                'priceAfterDiscount' => 764.99,
                'stockBeforeDiscount' => 10199.88,
                'stockAfterDiscount' => 9179.89,
            ]],
            'stoc la pragul minim' => [250.00, 5, [
                'discount' => 25.00,
                'priceAfterDiscount' => 225.00,
                'stockBeforeDiscount' => 1250.00,
                'stockAfterDiscount' => 1125.00,
            ]],
            'stoc epuizat' => [1200.00, 0, [
                'discount' => 120.00,
                'priceAfterDiscount' => 1080.00,
                'stockBeforeDiscount' => 0.00,
                'stockAfterDiscount' => 0.00,
            ]],
        ];
    }
}
