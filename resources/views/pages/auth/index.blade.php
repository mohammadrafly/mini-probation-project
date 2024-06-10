@extends('layouts.auth')

@section('content')

<div class="bg-white p-8 py-20 rounded-lg shadow-md w-[500px]">
    <h1 class="flex justify-center items-center text-2xl uppercase font-bold mb-5">{{ env('APP_NAME') }}</h1>
    @include('components.flash')
    <form action="{{ route('login')}}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="nip" class="block font-medium text-gray-700">NIP</label>
            <input type="number" id="nip" name="nip" placeholder="NIP" class="border shadow-sm mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-5">
        </div>
        <div>
            <label for="password" class="block font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" placeholder="******" class="border shadow-sm mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 py-2 px-5">
        </div>
        <div>
            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Login
            </button>
        </div>
    </form>
</div>

@endsection
