<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProblemaController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');

Route::match(['get', 'post'], '/problema/{p}', [ProblemaController::class, 'show'])->name('problema.show');
