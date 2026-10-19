<?php

namespace App\Http\Controllers;

use App\Enums\Role;

abstract class Controller
{
    public const string APP_VERSION = '0.1.0';

    public const Role DEMO_ROLE = Role::Visitor;

    /**
     * @return array<string, string|Role>
     */
    protected function commonViewData(string $pageTitle): array
    {
        return [
            'projectName' => 'Car Parts',
            'pageTitle' => $pageTitle,
            'author' => 'Pînzaru Daniel',
            'group' => 'PAPP-231',
            'description' => 'Aplicație web pentru administrarea unui magazin de piese auto și preluarea datelor prin formulare.',
            'version' => self::APP_VERSION,
            'role' => $this->currentRole(),
        ];
    }

    protected function currentRole(): Role
    {
        if (!app()->environment('local', 'testing')) {
            return Role::Visitor;
        }

        $storedRole = session('demo_role', self::DEMO_ROLE->value);

        if (!is_string($storedRole)) {
            return Role::Visitor;
        }

        return Role::tryFrom($storedRole) ?? Role::Visitor;
    }
}
