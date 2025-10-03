<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function ()
{
    Route::get('/invoices', function ()
    {
        return view('humano-billing::invoices.index');
    })->name('invoices.index');

    // Legacy aliases
    Route::prefix('invoice')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('invoices.index');
        })->name('invoice.index');
    });

    // Payments placeholder + legacy alias
    Route::get('/payments', function ()
    {
        return view('humano-billing::payments.index');
    })->name('payments.index');

    Route::prefix('payment')->group(function ()
    {
        Route::get('/list', function ()
        {
            return redirect()->route('payments.index');
        })->name('payment.index');
    });
});


