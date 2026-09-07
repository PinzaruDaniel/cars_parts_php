<?php

namespace App\Http\Controllers;

use App\Models\CarPart;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public const string APP_VERSION = 'v0.0.2';

    public function index(): View
    {
        $projectName = 'Cars Parts';
        $author = 'Pînzaru Daniel';
        $group = 'PAPP-231';
        $description = 'Aplicație web pentru administrarea unui magazin de piese auto și preluarea datelor introduse de utilizatori prin formulare.';
        $users = ['Clienți', 'Operatori magazin', 'Administratori'];
        $entities = ['Piesă auto', 'Categorie', 'Client', 'Comandă'];
        $carPart = new CarPart(
            id: 1,
            name: 'Plăcuțe de frână față',
            code: 'BP-BRE-001',
            category: 'Sistem de frânare',
            manufacturer: 'Brembo',
            price: 849.99,
            stockQuantity: 12,
            isAvailable: true,
        );
        $testCarParts = [
            $carPart,
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
        $testResults = [];

        foreach ($testCarParts as $testCarPart) {
            $testResults[] = [
                'carPart' => $testCarPart,
                'discountAmount' => $testCarPart->discountAmount(),
                'priceAfterDiscount' => $testCarPart->priceAfterDiscount(),
                'stockValueBeforeDiscount' => $testCarPart->stockValueBeforeDiscount(),
                'stockValueAfterDiscount' => $testCarPart->stockValueAfterDiscount(),
            ];
        }

        $highestStockValueResult = $testResults[0];
        $lowestStockValueResult = $testResults[0];

        foreach ($testResults as $testResult) {
            if ($testResult['stockValueAfterDiscount'] > $highestStockValueResult['stockValueAfterDiscount']) {
                $highestStockValueResult = $testResult;
            }

            if ($testResult['stockValueAfterDiscount'] < $lowestStockValueResult['stockValueAfterDiscount']) {
                $lowestStockValueResult = $testResult;
            }
        }

        return view('project', [
            'projectName' => $projectName,
            'author' => $author,
            'group' => $group,
            'description' => $description,
            'users' => $users,
            'entities' => $entities,
            'carPart' => $carPart,
            'lowStockThreshold' => CarPart::LOW_STOCK_THRESHOLD,
            'discountPercent' => CarPart::DISCOUNT_PERCENT,
            'discountAmount' => $carPart->discountAmount(),
            'priceAfterDiscount' => $carPart->priceAfterDiscount(),
            'stockValueBeforeDiscount' => $carPart->stockValueBeforeDiscount(),
            'stockValueAfterDiscount' => $carPart->stockValueAfterDiscount(),
            'testResults' => $testResults,
            'highestStockValueResult' => $highestStockValueResult,
            'lowestStockValueResult' => $lowestStockValueResult,
            'version' => self::APP_VERSION,
        ]);
    }
}
