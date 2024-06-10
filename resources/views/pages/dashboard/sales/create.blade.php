@extends('layouts.app')

@section('content')

@php
    use Akaunting\Money\Money;
@endphp

<div class="container mx-auto px-4 py-8">
    <form action="{{ route('sales.create') }}" method="POST" class="w-full mx-auto">
        @csrf
        <div class="mb-4">
            <label for="nama_pelanggan" class="block text-gray-700 font-bold mb-2">Nama Pelanggan:</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="alamat" class="block text-gray-700 font-bold mb-2">Alamat:</label>
            <textarea type="text" name="alamat" id="alamat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
        </div>
        <div class="mb-4">
            <label for="nomor_whatsapp" class="block text-gray-700 font-bold mb-2">Nomor WhatsApp:</label>
            <input type="number" name="nomor_whatsapp" id="nomor_whatsapp" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="mb-4">
            <label for="paket_id" class="block text-gray-700 font-bold mb-2">Paket:</label>
            <select name="paket_id" id="paket_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="" selected>Pilih Paket</option>
                @foreach($paket as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }} - {{ Money::IDR($p->harga, true) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Sales</button>
        </div>
    </form>
</div>

@endsection
