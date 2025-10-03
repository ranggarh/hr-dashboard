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
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-gray-200 w-full p-4 flex justify-between items-center fixed top-0 left-0 z-20" style="height:64px;">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-sm">HR</span>
            </div>
            <span class="font-bold text-xl text-gray-800">HR Assessment</span>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="flex items-center justify-center min-h-screen pt-20 pb-8">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>