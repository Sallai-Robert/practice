<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("create-book", [BookController::class, "create"]);
Route::get("books", [BookController::class, "index"]);
Route::get("books/{book}/download/original", [BookController::class, "downloadOriginal"]);
Route::get("books/{book}/download/printable", [BookController::class, "downloadPrintable"]);

require __DIR__.'/settings.php';
