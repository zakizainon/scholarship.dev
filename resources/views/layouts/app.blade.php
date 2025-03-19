<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PNB Scholarship') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Toastr -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            {{-- <body class="font-sans antialiased bg-gray-100">
                <div class="min-h-screen flex flex-col"> --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            
            </main>

            <!-- Page Content -->
            {{-- <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main> --}}

        </div>

        @include("notifications");

        <!-- <script src="./node_modules/preline/dist/preline.js"></script> -->
        <!-- <script>import "./node_modules/preline/dist/preline.js";</script> -->
        {{-- <script is:inline src="https://cdn.jsdelivr.net/npm/preline@2.5.1/dist/preline.min.js"></script> --}}
    </body>
    @yield('scripts')

    {{-- <script type="text/javascript">
        // toastr.success("Success Story");
    </script> --}}
</html>

