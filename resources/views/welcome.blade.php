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
    <div class="w-full h-full min-h-screen flex flex-col justify-center items-center">
        <h1 class="text-black dark:text-white text-6xl sm:text-9xl font-bold text-center mb-4">BookCall</h1>
        <p class="px-5 text-white max-w-4xl text-sm sm:text-md text-center">Make the most out of your valuable time with effortless call scheduling. Stay organized, eliminate back-and-forth, and focus on what truly matters—meaningful conversations</p>
        <div class="flex gap-4 my-8">
            @guest
            <a href="/login" class="block w-32 py-1 rounded-sm text-center font-semibold cursor-pointer duration-100 ease-in-out bg-zinc-400/25 text-black dark:text-gray-200">Login</a>
            <a href="/register" class="block w-32 py-1 rounded-sm text-center font-semibold cursor-pointer duration-100 ease-in-out bg-black dark:bg-white text-black dark:text-zinc-900">Register</a>
            @endguest
            @auth
            <a href="/profile" class="block w-32 py-1 rounded-sm text-center font-semibold cursor-pointer duration-100 ease-in-out bg-zinc-400/25 text-black dark:text-gray-200">My Account</a>
            <form method="POST" action="/logout">
                @csrf
                <button class="block w-32 py-1 rounded-sm text-center font-semibold cursor-pointer duration-100 ease-in-out bg-black dark:bg-white text-black dark:text-zinc-900">Log Out</button>
            </form>
            @endauth
        </div>
    </div>
</body>

</html>