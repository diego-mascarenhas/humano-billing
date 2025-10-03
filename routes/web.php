<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function ()
{
    Route::get('/invoices', function ()
    {
        return view('humano-billing::invoices.index');
    })->name('invoices.index');
});


