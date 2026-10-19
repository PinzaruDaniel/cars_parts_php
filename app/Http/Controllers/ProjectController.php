<?php

namespace App\Http\Controllers;

use App\Models\CarPart;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public const string APP_VERSION = '0.1.0';
    public const string DEMO_ROLE = 'vizitator';

    public function index(): View
    {
        $carParts = $this->carParts();
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

    public function catalog(): View
    {
        $searchInput = $_GET['q'] ?? '';
        $search = is_string($searchInput) ? trim($searchInput) : '';
        $carParts = $this->carParts();
        if ($search !== '') {
            $carParts = array_values(array_filter($carParts, fn(CarPart $carPart): bool => mb_stripos($carPart->name, $search) !== false || mb_stripos($carPart->code, $search) !== false
            ));
        }
        return view('pages.catalog', array_merge($this->commonViewData('Catalog'), [
            'carParts' => $carParts,
            'search' => $search,
        ]));
    }

    public function services(): View
    {
        return view('pages.services', $this->commonViewData('Servicii'));
    }

    public function contact(): View
    {
        return view('pages.contact', array_merge($this->commonViewData('Contact'), [
            'formData' => [
                'name' => '',
                'email' => '',
                'message' => '',
            ],
            'formErrors' => [],
            'successMessage' => null,
        ]));
    }

    public function login(): View
    {
        return view('pages.login', $this->commonViewData('Autentificare'));
    }

    public function administration(): View
    {
        if (!in_array(self::DEMO_ROLE, ['operator', 'administrator'], true)) {
            abort(403, 'Nu ai acces la aceasta pagina');
        }
        return view('pages.administration', array_merge($this->commonViewData('Administrare'), ['carParts' => $this->carParts()]));
    }

    /**
     * @return array<string, string>
     */
    private function commonViewData(string $pageTitle): array
    {
        return [
            'projectName' => 'Car Parts',
            'pageTitle' => $pageTitle,
            'author' => 'Pînzaru Daniel',
            'group' => 'PAPP-231',
            'description' => 'Aplicație web pentru administrarea unui magazin de piese auto și preluarea datelor introduse de utilizatori prin formulare.',
            'version' => self::APP_VERSION,
            'role' => self::DEMO_ROLE,
        ];
    }

    /**
     * @return array<int, CarPart>
     */
    private function carParts(): array
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
     * @param array<int, CarPart> $carParts
     * @return array<int, array{carPart: CarPart, discountAmount: float, priceAfterDiscount: float, stockValueBeforeDiscount: float, stockValueAfterDiscount: float}>
     */
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

    public function submitContact()
    {
        if (!in_array(self::DEMO_ROLE, ['vizitator', 'administrator'], true)) {
            abort(403, 'Nu ai acces la aceasta pagina');
        }
        $formData = [];
        $formErrors = [];
        foreach (['name', 'email', 'message'] as $field) {
            $value = $_POST[$field] ?? '';
            $formData[$field] = is_string($value) ? trim($value) : $value;
        }
        if ($formData['name'] === '') {
            $formErrors['name'] = 'Completeaza numele';
        }
        if ($formData['email'] === '') {
            $formErrors['email'] = 'Completeaza adresa email';
        } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $formErrors['email'] = 'Email invalid';
        }
        if ($formData['message'] === '') {
            $formErrors['message'] = 'Completeaza mesajul';
        }
        $successMessage = $formErrors == [] ? 'Solicitarea a fost prelucrata' : null;
        return view('pages.contact', array_merge(
            $this->commonViewData('Contact'),
            [
                'formData' => $formData,
                'formErrors' => $formErrors,
                'successMessage' => $successMessage,
            ],
        ));
    }
}
