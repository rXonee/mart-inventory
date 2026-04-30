<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TokoKu') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-teal-50 via-white to-emerald-50 min-h-screen">

    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">

        <!-- Decorative background circles -->
        <div class="fixed top-0 left-0 w-72 h-72 bg-[#2DC5A2]/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-teal-100/50 rounded-full blur-3xl translate-x-1/3 translate-y-1/3 pointer-events-none"></div>

        <!-- Card -->
        <div class="relative w-full max-w-sm bg-white rounded-3xl shadow-xl shadow-teal-100/50 px-7 py-8 border border-gray-100">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <p class="text-xs text-gray-300 mt-6 font-medium">© {{ date('Y') }} TokoKu. All rights reserved.</p>
    </div>

</body>
</html>