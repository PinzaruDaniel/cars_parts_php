<?php

namespace App\Http\Controllers;

use App\Models\CarPart;
use App\Services\CarPartStore;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(CarPartStore $carPartStore): View
    {
        $carParts = $carPartStore->examples();
        $carPart = $carParts[0];
        $testResults = $this->testResults($carParts);
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

        return view('pages.home', array_merge($this->commonViewData('Acasă'), [
            'users' => ['Clienți', 'Operatori magazin', 'Administratori'],
            'entities' => ['Piesă auto', 'Categorie', 'Client', 'Comandă'],
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
        ]));
    }
    private function testResults(array $carParts): array
    {
        $testResults = [];

        foreach ($carParts as $testCarPart) {
            $testResults[] = [
                'carPart' => $testCarPart,
                'discountAmount' => $testCarPart->discountAmount(),
                'priceAfterDiscount' => $testCarPart->priceAfterDiscount(),
                'stockValueBeforeDiscount' => $testCarPart->stockValueBeforeDiscount(),
                'stockValueAfterDiscount' => $testCarPart->stockValueAfterDiscount(),
            ];
        }

        return $testResults;
    }
}
