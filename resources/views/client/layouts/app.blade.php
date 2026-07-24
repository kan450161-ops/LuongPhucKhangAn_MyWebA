<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Web')</title>


    
    <!-- {{-- Vite --}} -->
    @vite(['resources/css/client.css', 'resources/js/client.js'])
</head>

<body>

    <!-- {{-- =================== HEADER TOP =================== --}} -->
    @include('client.partials.header')

    <!-- {{-- =================== NAVBAR =================== --}} -->
    @include('client.partials.navbar')

    <!-- {{-- =================== CONTENT =================== --}} -->
    <main class="container mt-3">
        @yield('content')
    </main>

    <!-- {{-- =================== FOOTER =================== --}} -->
    @include('client.partials.footer')

</body>

</html>