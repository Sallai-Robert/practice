<?php

use App\Http\Controllers\BookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("books/create", [BookController::class, "store"]);