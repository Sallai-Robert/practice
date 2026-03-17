<?php

namespace App\Services\Book;

use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BookService
{
public static function createBook(Request $request)
{
    // dd(Auth::id());
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
'pdf_original' => 'nullable|file|mimes:pdf',
'pdf_printable' => 'nullable|file|mimes:pdf',
'user_id'=>'nullable|number',
    ]);
    if ($request->hasFile('pdf_original')) {
        $validated['pdf_original'] = $request->file('pdf_original')->store('books/pdfs/originals', 'public');
    }
    if ($request->hasFile('pdf_printable')) {
        $validated['pdf_printable'] = $request->file('pdf_printable')->store('books/pdfs/printables', 'public');
    }
    $validated['user_id'] = Auth::id();
    Book::create($validated);
    return redirect("books");
    }
}