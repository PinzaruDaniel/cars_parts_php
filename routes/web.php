<?php

use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('project.index');

Route::get('/catalog', [CatalogController::class, 'index'])->name('project.catalog');

Route::get('/servicii', [ServicesController::class, 'index'])->name('project.services');

Route::get('/contact', [ContactController::class, 'index'])->name('project.contact');

Route::post('/contact', [ContactController::class, 'store'])->name('project.contact.submit');

Route::get('/autentificare', [LoginController::class, 'index'])->name('project.login');

Route::post('/autentificare/rol', [LoginController::class, 'switchRole'])->name('project.role.switch');

Route::get('/administrare', [AdministrationController::class, 'index'])->name('project.administration');

Route::post('/administrare/piese', [AdministrationController::class, 'store'])->name('project.car-parts.store');

Route::delete('/administrare/piese/{id}', [AdministrationController::class, 'destroy'])
    ->whereNumber('id')
    ->name('project.car-parts.destroy');
