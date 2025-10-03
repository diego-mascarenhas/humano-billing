<?php

namespace Idoneo\HumanoBilling\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        return view('humano-billing::payments.index');
    }

    public function data(): JsonResponse
    {
        if (! Schema::hasTable('payments')) {
            return response()->json(['data' => []]);
        }

        $rows = DB::table('payments')
            ->select(['id', 'date', 'enterprise_id', 'invoice_id', 'type_id', 'amount', 'status'])
            ->orderByDesc('date')
            ->limit(50)
            ->get()
            ->map(function ($r) {
                return [
                    'date' => (string) $r->date,
                    'enterprise_id' => $r->enterprise_id,
                    'invoice_id' => $r->invoice_id,
                    'type_id' => $r->type_id,
                    'amount' => number_format((float) $r->amount, 2),
                    'status' => $r->status,
                ];
            });

        return response()->json(['data' => $rows]);
    }
}


