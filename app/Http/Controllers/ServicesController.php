<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(): View
    {
        return view('pages.services', $this->commonViewData('Servicii'));
    }
}
