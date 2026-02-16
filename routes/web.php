<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\DraftDocumentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Mitra routes
    Route::get('mitras', [MitraController::class, 'index'])
        ->name('mitras.index');

    Route::get('mitras/create', [MitraController::class, 'create'])
        ->name('mitras.create');

    Route::post('mitras', [MitraController::class, 'store'])
        ->name('mitras.store');

    Route::get('mitras/{mitra}', [MitraController::class, 'show'])
        ->name('mitras.show');

    Route::get('mitras/{mitra}/edit', [MitraController::class, 'edit'])
        ->name('mitras.edit');

    Route::put('mitras/{mitra}', [MitraController::class, 'update'])
        ->name('mitras.update');

    Route::delete('mitras/{mitra}', [MitraController::class, 'destroy'])
        ->name('mitras.destroy');

    Route::get('api/mitras', [MitraController::class, 'getMitras'])
        ->name('mitras.api');

    // Invoice routes
    Route::get('invoices', [InvoiceController::class, 'index'])
        ->name('invoice');

    Route::get('invoices/create', [InvoiceController::class, 'create'])
        ->name('invoices.create');

    Route::post('invoices', [InvoiceController::class, 'store'])
        ->name('invoices.store');

    Route::get('invoices/{invoice}', [InvoiceController::class, 'show'])
        ->name('invoices.show');

    Route::get('invoices/{invoice}/edit', [InvoiceController::class, 'edit'])
        ->name('invoices.edit');

    Route::put('invoices/{invoice}', [InvoiceController::class, 'update'])
        ->name('invoices.update');

    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])
        ->name('invoices.print');

    Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPdf'])
        ->name('invoices.pdf');

    Route::delete('invoices/{invoice}', [InvoiceController::class, 'destroy'])
        ->name('invoices.destroy');

    Route::post('/invoice/{invoice}/approve', [InvoiceController::class, 'approve'])
        ->name('invoices.approve');

    // Draft Documents
    Route::get('draft-documents', [DraftDocumentController::class, 'index'])->name('draft-documents.index');
    Route::get('draft-documents/create', [DraftDocumentController::class, 'create'])->name('draft-documents.create');
    Route::post('draft-documents', [DraftDocumentController::class, 'store'])->name('draft-documents.store');
    Route::get('draft-documents/{draftDocument}', [DraftDocumentController::class, 'show'])->name('draft-documents.show');
    Route::get('draft-documents/{draftDocument}/edit', [DraftDocumentController::class, 'edit'])->name('draft-documents.edit');
    Route::put('draft-documents/{draftDocument}', [DraftDocumentController::class, 'update'])->name('draft-documents.update');
    Route::delete('draft-documents/{draftDocument}', [DraftDocumentController::class, 'destroy'])->name('draft-documents.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/settings.php';
