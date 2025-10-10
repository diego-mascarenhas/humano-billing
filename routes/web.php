<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function ()
{
    // NOTE: Invoice and Payment routes are now handled by the main application
    // See: routes/web.php in the main application

    // Accounting routes
    Route::get('/accounting', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'index'])->name('accounting.index');
    Route::get('/accounting/invoice/{id}', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'showInvoice'])->name('accounting.invoice');
    Route::get('/accounting/invoice/{id}/download', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadInvoice'])->name('accounting.invoice.download');
    Route::get('/accounting/customer/{id}', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'customerInvoices'])->name('accounting.customer');
    Route::get('/accounting/download-quarter', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadQuarterInvoices'])->name('accounting.download-quarter');
    Route::get('/accounting/download-quarter-csv', [\Idoneo\HumanoBilling\Http\Controllers\AccountingController::class, 'downloadQuarterCsv'])->name('accounting.download-quarter-csv');
});


