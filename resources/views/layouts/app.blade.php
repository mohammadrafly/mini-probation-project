<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME')}} | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.7/css/buttons.dataTables.min.css">
</head>
<body class="w-full min-h-screen bg-sky-100">
    <div class="flex">
        <div class="block w-full" x-data="{ open: true }">
            @include('layouts.partials.navbar')
            <div class="flex">
                @include('layouts.partials.sidebar')
                <div :class="open ? 'ml-[300px]' : ''" class="p-10 block w-full text-gray-500">
                    @include('components.flash')
                    <div class="mb-5">
                        <h1 class="font-bold text-2xl">{{ $title }}</h1>
                    </div>
                    <div class="bg-white p-5 text-gray-500">
                        @yield('content')
                    </div>
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite('resources/js/app.js')
    @yield('script')
    <script>
        $('table').dataTable();
    </script>
</body>
</html>
