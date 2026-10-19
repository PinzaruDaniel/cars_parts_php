<?php

namespace App\Http\Controllers;

use App\Models\CarPart;
use App\Services\CarPartStore;
use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function index(CarPartStore $carPartStore): View
    {
        $searchInput = $_GET['q'] ?? '';
        $search = is_string($searchInput) ? trim($searchInput) : '';
        $carParts = $carPartStore->examples();
        if ($search !== '') {
            $carParts = array_values(array_filter($carParts, fn(CarPart $carPart): bool => mb_stripos($carPart->name, $search) !== false || mb_stripos($carPart->code, $search) !== false
            ));
        }
        return view('pages.catalog', array_merge($this->commonViewData('Catalog'), [
            'carParts' => $carParts,
            'search' => $search,
        ]));
    }
}
