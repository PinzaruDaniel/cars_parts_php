<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    public const APP_VERSION = 'v0.0.1';

    public function index(): View
    {
        $projectName = 'Cars Parts';
        $author = 'Pînzaru Daniel';
        $group = 'PAPP-231';
        $description = 'Aplicație web pentru administrarea unui magazin de piese auto și preluarea datelor introduse de utilizatori prin formulare.';
        $users = ['Clienți', 'Operatori magazin', 'Administratori'];
        $entities = ['Piesă auto', 'Categorie', 'Client', 'Comandă'];

        return view('project', [
            'projectName' => $projectName,
            'author' => $author,
            'group' => $group,
            'description' => $description,
            'users' => $users,
            'entities' => $entities,
            'version' => self::APP_VERSION,
        ]);
    }
}
