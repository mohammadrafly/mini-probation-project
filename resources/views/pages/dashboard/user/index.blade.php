@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-8">
    <a href="{{route('user.create')}}" class="bg-blue-500 py-2 px-3 text-white rounded-md">Tambah User</a>
    <table id="myTable" class="w-full border-collapse table-auto">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2 text-left align-left">#</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Nama</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">NIP</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Role</th>
                <th class="border border-gray-400 px-4 py-2 text-left align-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr class="border border-gray-400">
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $index + 1 }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $item->name }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $item->nip }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">{{ $item->role }}</td>
                <td class="border border-gray-400 px-4 py-2 text-left align-left">
                    <a href="{{ route('user.update', $item->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                    <a href="#" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this item?')){ window.location.href = '{{ route('user.delete', $item->id) }}'; }">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
