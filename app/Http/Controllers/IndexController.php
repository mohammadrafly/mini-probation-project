<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $salesPerMonth = Sales::whereYear('created_at', now()->year)
            ->get()
            ->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('m');
            })
            ->map(function ($row) {
                return $row->count();
            });

        $salesPerMonthFormatted = $salesPerMonth->map(function ($total_sales, $month) {
            return [
                'month' => $month,
                'total_sales' => $total_sales
            ];
        })->values();

        $salesPerPackage = Sales::with('paket')->get()
            ->groupBy('paket.nama')
            ->map(function ($row) {
                return $row->count();
            });

        $salesPerPackageFormatted = $salesPerPackage->map(function ($total_sales, $nama) {
            return [
                'nama' => $nama,
                'total_sales' => $total_sales
            ];
        })->values();

        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'salesPerMonth' => $salesPerMonthFormatted,
            'salesPerPackage' => $salesPerPackageFormatted
        ]);
    }

    public function Logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil keluar dari sistem.');
    }
}
