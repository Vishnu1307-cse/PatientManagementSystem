<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Patient Management System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        @auth
            <nav class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo / App Name -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-indigo-600">
                                    PMS
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Dashboard
                                </a>
                                <a href="{{ url('/patients') }}" class="{{ request()->is('patients*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                    Patients
                                </a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'doctor')
                                    <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                        Doctors
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- User Settings / Logout -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <span class="text-sm text-gray-700 mr-4">Hello, {{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 w-full">
            @yield('content')
        </main>

        <footer class="bg-white border-t border-gray-200 mt-auto py-4 text-center text-sm text-gray-500">
            Patient Management System &copy; {{ date('Y') }}
        </footer>
    </div>
</body>
</html>
