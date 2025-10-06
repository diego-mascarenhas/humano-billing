<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function ()
{
    Route::get('/invoices', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{id}', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/data', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'data'])->name('invoices.data');

    // Legacy aliases
    Route::prefix('invoice')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('invoices.index');
        })->name('invoice.index');
        
        Route::get('/create', function ()
        {
            return redirect()->route('invoices.index');
        })->name('invoice.create');
        
        Route::get('/show/{id}', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.show');
        
        Route::get('/edit/{id}', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'show'])->name('invoice.edit');
        
        Route::delete('/destroy/{id}', function ($id)
        {
            return redirect()->route('invoices.index');
        })->name('invoice.destroy');
    });

    // Payments
    Route::get('/payments', [\Idoneo\HumanoBilling\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}', [\Idoneo\HumanoBilling\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');

    Route::prefix('payment')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('payments.index');
        })->name('payment.index');
    });

    // Accounting routes
    Route::get('/accounting', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'index'])->name('accounting.index');
    Route::get('/accounting/invoice/{id}', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'showInvoice'])->name('accounting.invoice');
    Route::get('/accounting/invoice/{id}/download', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadInvoice'])->name('accounting.invoice.download');
    Route::get('/accounting/customer/{id}', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'customerInvoices'])->name('accounting.customer');
    Route::get('/accounting/download-quarter', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadQuarterInvoices'])->name('accounting.download-quarter');
    Route::get('/accounting/download-quarter-csv', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadQuarterCsv'])->name('accounting.download-quarter-csv');
});


