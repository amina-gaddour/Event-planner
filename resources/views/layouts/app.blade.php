<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Planner</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    
    {{-- NAVBAR UNE SEULE FOIS --}}
    @include('partials.navbar')

    {{-- CONTENU UNIQUE --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER UNE SEULE FOIS --}}
    @include('partials.footer')

</body>

</html>