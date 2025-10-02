<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        .sidebar-collapsed {
            width: 4rem !important;
        }
        .sidebar-expanded {
            width: 12rem !important;
        }
        .sidebar-transition {
            transition: width 0.3s;
        }
        .menu-label {
            transition: opacity 0.2s, visibility 0.2s;
        }
        .menu-label.hide {
            opacity: 0;
            visibility: hidden;
            width: 0;
            padding: 0;
        }
        .menu-label.show {
            opacity: 1;
            visibility: visible;
            width: auto;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <header class="bg-white shadow-md w-full p-4 flex justify-between items-center fixed top-0 left-0 z-20" style="height:64px;">
            <div class="flex items-center space-x-2">
                <!-- Sidebar Toggle Button -->
                <button id="sidebarToggle" class="focus:outline-none text-2xl mr-2" type="button">
                    ☰
                </button>
                <h1 class="font-bold text-xl">@yield('title', 'HR Dashboard')</h1>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-sm">{{ Auth::user()->name ?? 'HR Recruiter' }}</span>
                <img src="https://ui-avatars.com/api/?name=HR" class="w-8 h-8 rounded-full" />
            </div>
        </header>

        <div class="flex flex-1 pt-16">
            <!-- Sidebar -->
            <aside id="sidebar" class="bg-white text-white min-h-screen sidebar-expanded sidebar-transition flex flex-col items-center py-4 relative z-10">
                <ul class="w-full space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-700 rounded transition-all duration-200">
                            <x-lucide-house class="w-6 h-6 text-black"/>
                            <span class="menu-label show text-black">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('assessments.index') }}" class="flex items-center space-x-3 p-3 hover:bg-gray-700 rounded transition-all duration-200">
                            <x-lucide-house class="w-6 h-6 text-black"/>
                            <span class="menu-label show text-black">Assessment Test</span>
                        </a>
                    </li>
                    <li>
                        <a href="/" class="flex items-center space-x-3 p-3 hover:bg-gray-700 rounded transition-all duration-200">
                            <x-lucide-user class="w-6 h-6 text-black"/>
                            <span class="menu-label show text-black">Jobseeker</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-6 transition-all duration-300">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const labels = document.querySelectorAll('.menu-label');
        let expanded = true;

        toggleBtn.addEventListener('click', function() {
            expanded = !expanded;
            if (expanded) {
                sidebar.classList.remove('sidebar-collapsed');
                sidebar.classList.add('sidebar-expanded');
                labels.forEach(label => {
                    label.classList.remove('hide');
                    label.classList.add('show');
                });
            } else {
                sidebar.classList.remove('sidebar-expanded');
                sidebar.classList.add('sidebar-collapsed');
                labels.forEach(label => {
                    label.classList.remove('show');
                    label.classList.add('hide');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>