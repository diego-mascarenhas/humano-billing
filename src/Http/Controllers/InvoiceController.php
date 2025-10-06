<?php

namespace Idoneo\HumanoBilling\Http\Controllers;

use Idoneo\HumanoBilling\DataTables\InvoiceDataTable;
use Idoneo\HumanoBilling\Models\Invoice;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('humano-billing::invoices.index');
    }

    public function show($id): View
    {
        $invoice = Invoice::with(['enterprise', 'items.category', 'type'])->findOrFail($id);
        
        return view('humano-billing::invoices.show', compact('invoice'));
    }
}


