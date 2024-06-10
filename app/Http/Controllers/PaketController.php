<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.paket.index', [
            'data' => Paket::all(),
            'title' => 'Data Paket'
        ]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'harga' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            try {
                Paket::create($validator->validated());

                return redirect()->route('paket.index')->with('success', 'Success! New Paket has been created.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Oops! Failed to create new Paket.');
            }
        }

        return view('pages.dashboard.paket.create', [
            'title' => 'Data Paket'
        ]);
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::find($id);

        if (!$paket) {
            return redirect()->route('paket.index')->with('error', 'Oops! The Paket you are trying to update does not exist.');
        }

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'harga' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                $paket->update($validator->validated());

                return redirect()->route('paket.index')->with('success', 'Success! Paket has been updated.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Oops! Failed to update Paket.');
            }
        }

        return view('pages.dashboard.paket.update', [
            'title' => 'Update Paket',
            'paket' => $paket,
        ]);
    }

    public function delete($id)
    {
        $data = Paket::find($id);

        if (!$data) {
            return redirect()->route('paket.index')->with('error', 'Opps! the data ur trying to find is not exist.');
        }

        if (!$data->delete()) {
            return redirect()->route('paket.index')->with('error', 'Opps! failed to delete data.');
        }

        return redirect()->route('paket.index')->with('success', 'Success! looks like the operation is successfull.');
    }
}
