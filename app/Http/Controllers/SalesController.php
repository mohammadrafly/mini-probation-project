<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use Carbon\Carbon;

class SalesController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.sales.index', [
            'data' => Sales::with('user', 'paket')->get(),
            'title' => 'Data Sales'
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nama_pelanggan' => 'required|string',
                'alamat' => 'required|string',
                'nomor_whatsapp' => 'required|integer',
                'paket_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $validator->validated();

            $data['user_id'] = Auth::user()->id;

            try {
                Sales::create($data);

                return redirect()->route('sales.index')->with('success', 'Success! New Sales has been created.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Oops! Failed to create new Sales.');
            }
        }

        return view('pages.dashboard.sales.create', [
            'user' => User::where('role', 'sales')->get(),
            'paket' => Paket::all(),
            'title' => 'Data Sales'
        ]);
    }

    public function exportExcel(Request $request)
    {
        $request->validate([
            'start_month' => 'required|date',
            'end_month' => 'required|date',
        ]);

        $startMonth = Carbon::createFromFormat('Y-m-d', $request->input('start_month'))->startOfMonth();
        $endMonth = Carbon::createFromFormat('Y-m-d', $request->input('end_month'))->endOfMonth();

        $salesData = Sales::with('user', 'paket')
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->get();

        return Excel::download(new SalesExport($salesData), 'sales_'. $startMonth . '-' . $endMonth .'.xlsx');
    }
}
