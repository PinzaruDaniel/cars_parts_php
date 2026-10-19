<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('project.index');
Route::get('/catalog', [ProjectController::class, 'catalog'])->name('project.catalog');
Route::get('/servicii', [ProjectController::class, 'services'])->name('project.services');
Route::get('/contact', [ProjectController::class, 'contact'])->name('project.contact');
Route::post('/contact', [ProjectController::class, 'submitContact'])->name('project.contact.submit');
Route::get('/autentificare', [ProjectController::class, 'login'])->name('project.login');
Route::get('/administrare', [ProjectController::class, 'administration'])->name('project.administration');
