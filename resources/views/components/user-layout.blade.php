<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div>
        <!-- nav links  -->
        <ul>
            <li>
                <a href="/bookings">Bookings</a>
            </li>
            <li>
                <a href="/profile">Profile</a>
            </li>
            <li>
                <a href="/availablity">Availability</a>
            </li>
        </ul>
    </div>
    @guest
    You are a guest.
    @endguest
    @auth
    You are logged in.
    <form method="POST" action="/logout">
        @csrf
        <button class="hover:bg-slate-500 px-3 py-2 rounded-md text-sm font-medium text-white">Log Out</button>
    </form>
    @endauth
    <div class="border-2 border-red-500">
        {{$slot}}
    </div>
</body>

</html>