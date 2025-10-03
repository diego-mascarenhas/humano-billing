<?php

namespace Idoneo\HumanoBilling\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        return view('humano-billing::invoices.index');
    }

    public function data(): JsonResponse
    {
        if (! Schema::hasTable('invoices')) {
            return response()->json(['data' => []]);
        }

        $rows = DB::table('invoices')
            ->select(['id', 'number', 'date', 'enterprise_id', 'operation', 'total_amount', 'discount', 'balance', 'status'])
            ->orderByDesc('date')
            ->limit(50)
            ->get()
            ->map(function ($r) {
                return [
                    'number' => $r->number,
                    'date' => (string) $r->date,
                    'enterprise_id' => $r->enterprise_id,
                    'operation' => $r->operation,
                    'total_amount' => number_format((float) $r->total_amount, 2),
                    'discount' => number_format((float) ($r->discount ?? 0), 2),
                    'balance' => number_format((float) ($r->balance ?? 0), 2),
                    'status' => $r->status,
                ];
            });

        return response()->json(['data' => $rows]);
    }
}


