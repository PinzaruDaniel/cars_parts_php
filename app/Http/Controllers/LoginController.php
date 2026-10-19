<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('pages.login', array_merge(
            $this->commonViewData('Autentificare'),
            [
                'roles' => Role::cases(),
                'canSwitchRole' => app()->environment('local', 'testing'),
            ],
        ));
    }

    public function switchRole(Request $request): RedirectResponse
    {
        abort_unless(
            app()->environment('local', 'testing'),
            403,
            'Schimbarea rolului este disponibilă doar pentru demonstrație locală.',
        );

        $data = $request->validate([
            'role' => ['required', 'string', Rule::enum(Role::class)],
        ], [
            'role.required' => 'Alege un rol.',
            'role.string' => 'Rolul nu este valid.',
            'role.enum' => 'Rolul nu este valid.',
        ]);

        $request->session()->put('demo_role', $data['role']);

        return redirect()
            ->route('project.login')
            ->with('roleMessage', 'Rolul demonstrativ a fost schimbat.');
    }
}
