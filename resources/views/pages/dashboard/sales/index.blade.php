@extends('layouts.app')

@section('content')

@php
    use Akaunting\Money\Money;
@endphp

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center">
        <a href="{{ route('sales.create') }}" class="bg-blue-500 py-2 px-3 text-white rounded-md">Tambah Sales</a>
        <form action="{{ route('sales.export') }}" method="get" class="mt-4">
            <div class="flex space-x-4">
                <div class="flex flex-col">
                    <label for="start_month" class="text-sm font-medium text-gray-700">Start Date:</label>
                    <input type="date" id="start_month" name="start_month" class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex flex-col">
                    <label for="end_month" class="text-sm font-medium text-gray-700">End Date:</label>
                    <input type="date" id="end_month" name="end_month" class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Export Excel</button>
                </div>
            </div>
        </form>
    </div>
    <table id="sales" class="w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2 text-left align-left">#</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Sales</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Nama Pelanggan</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Alamat</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Nomor WhatsApp</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Paket ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $sale)
            <tr class="border border-gray-400">
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $index + 1 }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $sale->user->name }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $sale->nama_pelanggan }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $sale->alamat }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $sale->nomor_whatsapp }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $sale->paket->nama }} - {{ Money::IDR($sale->paket->harga, true)}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
