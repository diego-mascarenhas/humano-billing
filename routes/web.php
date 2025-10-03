<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function ()
{
    Route::get('/invoices', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/data', [\Idoneo\HumanoBilling\Http\Controllers\InvoiceController::class, 'data'])->name('invoices.data');

    // Legacy aliases
    Route::prefix('invoice')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('invoices.index');
        })->name('invoice.index');
    });

    // Payments placeholder + legacy alias
    Route::get('/payments', [\Idoneo\HumanoBilling\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/data', [\Idoneo\HumanoBilling\Http\Controllers\PaymentController::class, 'data'])->name('payments.data');

    Route::prefix('payment')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('payments.index');
        })->name('payment.index');
    });
});


