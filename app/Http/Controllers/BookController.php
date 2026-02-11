<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\Book\BookService;

use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Books", [
            "books" => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("CreateBook");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return BookService::createBook($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
public function downloadOriginal(Book $book)
{
    if (!Storage::disk('public')->exists($book->pdf_original)) {
        abort(404, "File not found");
    }

    return Storage::disk('public')->download($book->pdf_original, $book->title . '_original.pdf');
}
public function downloadPrintable(Book $book)
{
    return Storage::download($book->pdf_printable);
}
}
