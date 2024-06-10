@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <form action="{{ route('paket.create') }}" method="POST" class="w-full mx-auto">
        @csrf
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 font-bold mb-2">Nama:</label>
            <input type="text" name="nama" id="nama" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700 font-bold mb-2">Harga:</label>
            <input type="number" name="harga" id="harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Tambah Paket</button>
        </div>
    </form>
</div>

@endsection
