<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $salesPerMonth = Sales::selectRaw('MONTH(created_at) as month, COUNT(*) as total_sales')
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $salesPerPackage = Sales::join('paket', 'sales.paket_id', '=', 'paket.id')
            ->select('paket.nama', DB::raw('count(*) as total_sales'))
            ->groupBy('paket.nama')
            ->get();

        return view('pages.dashboard.index', [
        //dd([
            'title' => 'Dashboard',
            'salesPerMonth' => $salesPerMonth,
            'salesPerPackage' => $salesPerPackage
        ]);
    }
}
