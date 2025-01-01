<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'BookCall' }}</title>
    <script src="{{ asset('js/tailwind.js') }}"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white">
    {{ $slot }}
</body>

</html>