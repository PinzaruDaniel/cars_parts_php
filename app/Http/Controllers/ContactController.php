<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(): View
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

    public function store()
    {
        abort_unless(
            $this->currentRole()->canSubmitContact(),
            403,
            'Nu ai acces la această acțiune.',
        );
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
