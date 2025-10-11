<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'HR Assessment')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('head')
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Main Content -->
    <main class="flex items-center justify-center min-h-screen pt-20 pb-8">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>