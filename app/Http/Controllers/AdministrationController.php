<?php

namespace App\Http\Controllers;

use App\Services\CarPartStore;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdministrationController extends Controller
{
    public function index(CarPartStore $carPartStore): View
    {
        abort_unless(
            $this->currentRole()->canViewAdministration(),
            403,
            'Nu ai acces la această pagină.',
        );

        return view('pages.administration', array_merge(
            $this->commonViewData('Administrare'),
            ['carParts' => $carPartStore->all()],
        ));
    }

    public function store(
        Request $request,
        CarPartStore $carPartStore,
    ): RedirectResponse {
        abort_unless(
            $this->currentRole()->canManageCarParts(),
            403,
            'Doar administratorul poate adăuga piese.',
        );

        $data = $request->validate([
            'name' => ['bail', 'required', 'string', 'max:150'],
            'code' => ['bail', 'required', 'string', 'max:64'],
            'category' => ['bail', 'required', 'string', 'max:100'],
            'manufacturer' => ['bail', 'required', 'string', 'max:100'],
            'price' => [
                'bail', 'required', 'numeric',
                'min:0', 'max:999999999.99', 'decimal:0,2',
            ],
            'stockQuantity' => [
                'bail', 'required', 'integer',
                'min:0', 'max:2147483647',
            ],
            'isAvailable' => ['sometimes', 'boolean'],
        ], [
            'required' => 'Completează câmpul :attribute.',
            'string' => 'Câmpul :attribute trebuie să fie text.',
            'numeric' => 'Introdu un număr valid.',
            'integer' => 'Introdu un număr întreg.',
            'min' => 'Valoarea nu poate fi negativă.',
            'max' => 'Câmpul :attribute depășește limita :max.',
            'decimal' => 'Prețul poate avea maximum două zecimale.',
            'boolean' => 'Disponibilitatea nu este validă.',
        ], [
            'name' => 'denumire',
            'code' => 'cod',
            'category' => 'categorie',
            'manufacturer' => 'producător',
            'price' => 'preț',
            'stockQuantity' => 'stoc',
            'isAvailable' => 'disponibilitate',
        ]);

        foreach ($carPartStore->all() as $carPart) {
            if (
                mb_strtoupper($carPart->code)
                === mb_strtoupper($data['code'])
            ) {
                throw ValidationException::withMessages([
                    'code' => 'Există deja o piesă cu acest cod.',
                ]);
            }
        }

        $carPartStore->add($data);

        return redirect()
            ->route('project.administration')
            ->with('successMessage', 'Piesa a fost adăugată.');
    }

    public function destroy(
        int $id,
        CarPartStore $carPartStore,
    ): RedirectResponse {
        abort_unless(
            $this->currentRole()->canManageCarParts(),
            403,
            'Doar administratorul poate șterge piese.',
        );

        abort_unless(
            $carPartStore->delete($id),
            404,
            'Piesa nu a fost găsită.',
        );

        return redirect()
            ->route('project.administration')
            ->with('successMessage', 'Piesa a fost ștearsă.');
    }
}
