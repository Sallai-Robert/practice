<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Models\Book;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
        'books'=>Book::all(),   
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get("books", [BookController::class, "index"])->name("books");
Route::get("books/create", [BookController::class, "create"])->middleware(['auth']);
Route::get("books/{book}/download/original", [BookController::class, "downloadOriginal"]);
Route::get("books/{book}/download/printable", [BookController::class, "downloadPrintable"]);
Route::post("books/create", [BookController::class, "store"]);
require __DIR__.'/settings.php';
