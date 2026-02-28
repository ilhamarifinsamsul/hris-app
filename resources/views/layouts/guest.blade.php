<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <svg width="180" height="50" viewBox="0 0 180 50" xmlns="http://www.w3.org/2000/svg">
                <!-- Background Circle -->
                <circle cx="25" cy="25" r="20" fill="#4e73df" />

                <!-- People Icon -->
                <circle cx="20" cy="22" r="4" fill="white" />
                <circle cx="30" cy="22" r="4" fill="white" />
                <rect x="16" y="27" width="18" height="6" rx="3" fill="white" />

                <!-- Text -->
                <text x="55" y="30" font-family="Arial, sans-serif" font-size="20" font-weight="bold" fill="#343a40">
                    HR System
                </text>
            </svg>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
