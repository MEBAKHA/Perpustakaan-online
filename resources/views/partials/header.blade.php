<header class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            
            <!-- Title -->
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
               Welcome to {{ $title ?? 'LITEMARI' }}
            </h1>

            <!-- User Button -->
            <a 
                class="flex items-center justify-center sm:justify-start gap-2 w-full sm:w-auto text-sm sm:text-lg bg-purple-500 text-blue-50 border-2 border-b-purple-700 py-2 px-4 rounded-2xl focus:outline-offset-1 focus:ring-1 focus:ring-blue-600"
                href="{{ auth()->check() && auth()->user()->role == 'admin' 
                    ? route('dashboard') 
                    : (auth()->check() && auth()->user()->role == 'user' 
                        ? route('profile') 
                        : route('login')) }}"
            >
                <i class="fa-solid fa-user"></i>
                {{ auth()->user()?->username ?? 'Guest' }}
            </a>

        </div>

    </div>
</header>