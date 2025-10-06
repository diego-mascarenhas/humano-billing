<?php

namespace Idoneo\HumanoBilling\Http\Controllers;

use Idoneo\HumanoBilling\DataTables\PaymentDataTable;
use Idoneo\HumanoBilling\Models\Payment;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PaymentController extends Controller
{
	public function index(PaymentDataTable $dataTable)
	{
		return $dataTable->render('humano-billing::payments.index');
	}

	public function show($id): View
	{
		$payment = Payment::with(['enterprise', 'invoice', 'account', 'type'])->findOrFail($id);

		return view('humano-billing::payments.show', compact('payment'));
	}
}