<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ Auth::user()->isHR() ? 'HR Dashboard' : 'Jobseeker Portal' }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        .sidebar-collapsed {
            width: 4rem !important;
        }

        .sidebar-expanded {
            width: 14rem !important;
        }

        .sidebar-transition {
            transition: all 0.3s ease-in-out;
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

        .menu-item {
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, transparent 100%);
            transition: width 0.3s ease;
        }

        .menu-item:hover::before,
        .menu-item.active::before {
            width: 100%;
        }

        .menu-item.active {
            background: rgba(59, 130, 246, 0.05);
        }

        .sidebar-collapsed .menu-item {
            padding: 1rem 0.75rem;
        }

        .sidebar-collapsed .sidebar-header {
            padding: 0.5rem 0.75rem;
        }

        .sidebar-collapsed .sidebar-footer {
            padding: 1rem 0.75rem;
        }
    </style>
</head>

<body class="bg-gray-50">

    <div class="flex flex-col min-h-screen">
        <!-- Navbar -->
        <header
            class="bg-white shadow-sm border-b border-gray-200 w-full p-4 flex justify-between items-center fixed top-0 left-0 z-20"
            style="height:64px;">
            <div class="flex items-center space-x-4">
                <!-- Sidebar Toggle Button -->
                <button id="sidebarToggle"
                    class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 transition-colors"
                    type="button">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 {{ Auth::user()->isHR() ? 'bg-blue-600' : 'bg-green-600' }} rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">{{ Auth::user()->isHR() ? 'HR' : 'JS' }}</span>
                    </div>
                    <h1 class="font-bold text-xl text-gray-800">@yield('title', Auth::user()->isHR() ? 'HR Assessment' : 'My Assessment')</h1>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->isHR() ? 'Human Resources' : 'Job Seeker' }}</p>
                </div>
                <div
                    class="w-10 h-10 {{ Auth::user()->isHR() ? 'bg-gradient-to-br from-blue-500 to-purple-600' : 'bg-gradient-to-br from-green-500 to-teal-600' }} rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 2) }}</span>
                </div>
            </div>
        </header>

        <div class="flex flex-1 pt-16">
            <!-- Sidebar -->
            <aside id="sidebar"
                class="bg-white border-r border-gray-200 min-h-screen sidebar-expanded sidebar-transition flex flex-col shadow-sm">
                <!-- Sidebar Header -->
                <div class="sidebar-header p-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 {{ Auth::user()->isHR() ? 'bg-gradient-to-br from-blue-500 to-indigo-600' : 'bg-gradient-to-br from-green-500 to-teal-600' }} rounded-xl flex items-center justify-center flex-shrink-0">
                            @if(Auth::user()->isHR())
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            @endif
                        </div>
                        <div class="menu-label show">
                            <h3 class="font-bold text-gray-900">{{ Auth::user()->isHR() ? 'HR System' : 'Jobseeker Portal' }}</h3>
                            <p class="text-xs text-gray-500">{{ Auth::user()->isHR() ? 'Assessment Platform' : 'Career Platform' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1">
                    <div class="space-y-2">
                        
                        @if(Auth::user()->isHR())
                            {{-- HR Menu --}}
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('dashboard') ? 'bg-blue-100' : 'bg-gray-100 group-hover:bg-blue-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-600 group-hover:text-blue-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2v0"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 5v4M16 5v4"></path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-600' : 'text-gray-700 group-hover:text-gray-900' }}">Dashboard</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Overview & analytics</p>
                                </div>
                            </a>

                            <!-- Assessment Tests -->
                            <a href="{{ route('assessments.index') }}"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('assessments.*') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('assessments.*') ? 'bg-blue-100' : 'bg-gray-100 group-hover:bg-blue-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('assessments.*') ? 'text-blue-600' : 'text-gray-600 group-hover:text-blue-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('assessments.*') ? 'text-blue-600' : 'text-gray-700 group-hover:text-gray-900' }}">Assessment Tests</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Kelola tes penilaian</p>
                                </div>
                            </a>

                            <!-- Candidates -->
                            <a href="{{ route('jobseekers.index') }}"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('jobseekers.*') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('jobseekers.*') ? 'bg-blue-100' : 'bg-gray-100 group-hover:bg-blue-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('jobseekers.*') ? 'text-blue-600' : 'text-gray-600 group-hover:text-blue-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('jobseekers.*') ? 'text-blue-600' : 'text-gray-700 group-hover:text-gray-900' }}">Candidates</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Kelola kandidat</p>
                                </div>
                            </a>

                        @else
                            {{-- Jobseeker Menu --}}
                            <!-- Dashboard -->
                            <a href="{{ route('jobseeker.dashboard') }}"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('jobseeker.dashboard') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('jobseeker.dashboard') ? 'bg-green-100' : 'bg-gray-100 group-hover:bg-green-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('jobseeker.dashboard') ? 'text-green-600' : 'text-gray-600 group-hover:text-green-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                        </path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('jobseeker.dashboard') ? 'text-green-600' : 'text-gray-700 group-hover:text-gray-900' }}">Home</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Beranda saya</p>
                                </div>
                            </a>

                            <!-- My Assessments -->
                            <a href="#"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('jobseeker.assessments') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('jobseeker.assessments') ? 'bg-green-100' : 'bg-gray-100 group-hover:bg-green-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('jobseeker.assessments') ? 'text-green-600' : 'text-gray-600 group-hover:text-green-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                        </path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('jobseeker.assessments') ? 'text-green-600' : 'text-gray-700 group-hover:text-gray-900' }}">My Assessments</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Tes yang harus dikerjakan</p>
                                </div>
                            </a>

                            <!-- Profile -->
                            <a href="#"
                                class="menu-item group flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('jobseeker.profile') ? 'active' : 'hover:bg-gray-50' }}">
                                <div
                                    class="w-10 h-10 rounded-lg flex items-center justify-center transition-colors flex-shrink-0 {{ request()->routeIs('jobseeker.profile') ? 'bg-green-100' : 'bg-gray-100 group-hover:bg-green-50' }}">
                                    <svg class="w-5 h-5 transition-colors {{ request()->routeIs('jobseeker.profile') ? 'text-green-600' : 'text-gray-600 group-hover:text-green-500' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="menu-label show">
                                    <span
                                        class="font-medium transition-colors {{ request()->routeIs('jobseeker.profile') ? 'text-green-600' : 'text-gray-700 group-hover:text-gray-900' }}">My Profile</span>
                                    <p class="text-xs text-gray-500 mt-0.5">Edit profil saya</p>
                                </div>
                            </a>
                        @endif

                    </div>
                </nav>

                <!-- Sidebar Footer -->
                <div class="sidebar-footer p-4 border-t border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 rounded flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1">
                                </path>
                            </svg>
                            <span class="menu-label show">Logout</span>
                        </button>
                    </form>
                    <div class="menu-label show mt-4">
                        <div class="bg-gradient-to-r {{ Auth::user()->isHR() ? 'from-blue-50 to-indigo-50' : 'from-green-50 to-teal-50' }} rounded-xl p-4">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-8 h-8 {{ Auth::user()->isHR() ? 'bg-blue-100' : 'bg-green-100' }} rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 {{ Auth::user()->isHR() ? 'text-blue-600' : 'text-green-600' }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Need Help?</p>
                                    <p class="text-xs text-gray-600">Contact support</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 transition-all duration-300">
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