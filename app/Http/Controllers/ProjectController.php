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
            'version' => self::APP_VERSION,
        ]);
    }
}
