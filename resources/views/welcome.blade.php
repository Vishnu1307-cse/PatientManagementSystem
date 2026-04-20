<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patient Management System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-slate-50 text-slate-800 selection:bg-indigo-500 selection:text-white font-sans">
    
    <!-- Navigation -->
    <nav class="absolute w-full px-6 py-4 flex justify-between items-center z-10">
        <div class="text-2xl font-extrabold text-indigo-600 tracking-tight">
            PMS
        </div>
        <div>
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-medium text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:text-indigo-600 transition">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition shadow-md shadow-indigo-200">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative min-h-screen flex items-center justify-center overflow-hidden">
        
        <!-- Decorative Background Gradients -->
        <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-indigo-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-70 animate-blob animation-delay-4000"></div>

        <div class="relative z-10 text-center px-4 max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6 drop-shadow-sm">
                Patient Management <br /> <span class="text-indigo-600">Simplified.</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed font-medium">
                A secure, role-based platform for Admins, Doctors, and Receptionists to seamlessly manage patient records, visits, and reports.
            </p>
            
            @if (!Auth::check())
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('login') }}" class="px-8 py-3.5 text-lg font-semibold rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition shadow-lg shadow-indigo-300 transform hover:-translate-y-0.5">
                        Get Started
                    </a>
                    <a href="#features" class="px-8 py-3.5 text-lg font-semibold rounded-full bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 transition shadow-sm transform hover:-translate-y-0.5">
                        Learn More
                    </a>
                </div>
            @else
                <a href="{{ url('/dashboard') }}" class="px-8 py-3.5 text-lg font-semibold rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition shadow-lg shadow-indigo-300 inline-block transform hover:-translate-y-0.5">
                    Go to Dashboard
                </a>
            @endif
        </div>
    </main>

</body>
</html>
