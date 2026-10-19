<?php

namespace App\Services;

use App\Models\CarPart;

class CarPartStore
{
    /**
     * @return array<int, CarPart>
     */
    public function examples(): array
    {
        return [
            new CarPart(
                id: 1,
                name: 'Plăcuțe de frână față',
                code: 'BP-BRE-001',
                category: 'Sistem de frânare',
                manufacturer: 'Brembo',
                price: 849.99,
                stockQuantity: 12,
                isAvailable: true,
            ),
            new CarPart(
                id: 2,
                name: 'Filtru de ulei',
                code: 'OF-MAN-002',
                category: 'Filtrare',
                manufacturer: 'MANN-FILTER',
                price: 250.00,
                stockQuantity: 5,
                isAvailable: true,
            ),
            new CarPart(
                id: 3,
                name: 'Kit ambreiaj',
                code: 'CK-LUK-003',
                category: 'Transmisie',
                manufacturer: 'LuK',
                price: 1200.00,
                stockQuantity: 0,
                isAvailable: false,
            ),
        ];
    }

    /**
     * @return array<int, CarPart>
     */
    public function all(): array
    {
        $storedParts = session('car_parts');

        if ($storedParts === null) {
            return $this->examples();
        }

        return array_map(
            fn(array $data): CarPart => new CarPart(...$data),
            $storedParts,
        );
    }

    /**
     * @param array{
     *     name: string,
     *     code: string,
     *     category: string,
     *     manufacturer: string,
     *     price: string|int|float,
     *     stockQuantity: string|int,
     *     isAvailable?: string|int|bool
     * } $data
     */
    public function add(array $data): void
    {
        $carParts = $this->all();
        $nextId = session('car_parts_next_id', 4);

        $carParts[] = new CarPart(
            id: $nextId,
            name: $data['name'],
            code: mb_strtoupper($data['code']),
            category: $data['category'],
            manufacturer: $data['manufacturer'],
            price: (float)$data['price'],
            stockQuantity: (int)$data['stockQuantity'],
            isAvailable: (bool)($data['isAvailable'] ?? false),
        );

        session([
            'car_parts' => array_map(
                fn(CarPart $carPart): array => get_object_vars($carPart),
                $carParts,
            ),
            'car_parts_next_id' => $nextId + 1,
        ]);
    }

    public function delete(int $id): bool
    {
        $carParts = $this->all();

        $remainingParts = array_values(array_filter(
            $carParts,
            fn(CarPart $carPart): bool => $carPart->id !== $id,
        ));

        if (count($remainingParts) === count($carParts)) {
            return false;
        }

        session([
            'car_parts' => array_map(
                fn(CarPart $carPart): array => get_object_vars($carPart),
                $remainingParts,
            ),
        ]);

        return true;
    }
}
