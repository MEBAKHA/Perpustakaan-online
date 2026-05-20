<nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
            <div class="shrink-0 flex items-center">
               <img class=" h-10 w-auto" src="{{ asset('img/logo (2).png') }}" alt="">
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="/" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" aria-current="page"><i class="fa-solid fa-house"></i> Homepage</a>
                    <a href="/hall" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('hall*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"> <i class="fa-solid fa-border-all"></i> Hall</a>
                    @auth
                        <a href="/people" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('about*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"><i class="fa-solid fa-person mr-2"></i>People</a>
                    @endauth
                    @auth
                    <a href="/borrows/{{auth()->user()->slug }}" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('borrows*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"> <i class="fa-solid fa-repeat"></i> Posting Ulang </a>
                    @endauth
                </div>
            </div>

        </div>
        @auth
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                <!-- Profile dropdown -->
                <div class="relative ml-3">
                    <div>
                    <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">Open user menu</span> 
                        @auth
                            <img 
                                src="{{ auth()->user()->avatar 
                                    ? asset('storage/' . auth()->user()->avatar) 
                                    : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                                class="w-10 h-10 rounded-full border-4 border-white shadow-lg"
                            >
                         @endauth
                    >
                       
                    </button>
                    </div>

                    <div 
                        x-show="isOpen"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 ring-1 shadow-lg ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                        <a href="/profile/{{ auth()->user()->username }}" class="block px-4 py-2 text-sm text-gray-700 focus:text-cyan-600 hover:bg-gray-100 transition" role="menuitem" tabindex="-1" id="user-menu-item-0"> <i class="fa-solid fa-circle-user"></i> {{ auth()->user()->name }}</a>
                        @if (auth()->user()->role == 'admin')
                            <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition" role="menuitem" tabindex="-1" id="user-menu-item-0"><i class="fa-solid fa-display"></i> Dashboard</a>
                        @endif
                        <a href="{{ route('story.create') }}" class="block px-4 py-2 text-sm text-gray-700 focus:text-cyan-600  hover:bg-gray-100 transition "> <i class="fa-solid fa-plus"></i> create Story</a>
                        <a href="/about" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"><i class="fa-solid fa-circle-info mr-2"></i>About</a>
                        <a href="/about" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition"><i class="fa-solid fa-gear mr-2"></i>Settings</a>
                        <form action="/logout" method="POST">
                            @csrf
                            <button onclick="return confirm('Apakah anda yakin untuk logout?')" type="submit" class="cursor-pointer px-4 py-2 text-sm text-red-500 hover:bg-gray-100 transition w-full text-left" role="menuitem" tabindex="-1" id="user-menu-item-2"><i class="fa-solid fa-up-right-from-square mr-3"></i>Sign out</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open main menu</span>
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
        @else
            <a class=" bg-transparent border border-white shadow-2xl shadow-amber-50 px-6 py-2 rounded text-white hover:bg-emerald-400/5 hover:text-emerald-300 hover:border hover:border-emerald-500 hover:shadow-2xl hover:shadow-emerald-400 hover:px-5 hover:py-3 transition-all duration-500 font-semibold text-lg h" href="/login"><i class="fa-solid fa-circle-user mr-4"></i>Login</a>
        @endauth
        </div>
    </div>

    @auth
        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="isOpen" class="md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="/" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" aria-current="page">Homepage</a>
                <a href="/hall" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('hall*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Hall</a>
                @auth
                    <a href="/borrows/{{auth()->user()->slug }}" class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('borrows*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"> <i class="fa-solid fa-repeat"></i> Posting Ulang </a>
                @endauth
                <a href="/about" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('about*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">About</a>
                @auth
                    <a href="/people" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('people*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}"><i class="fa-solid fa-person mr-2"></i>People</a>
                @endauth
                <a href="/about" class="block rounded-md px-3 py-2 text-base font-medium {{ request()->is('about*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}><i class="fa-solid fa-gear mr-2"></i>Settings</a>
            </div>
            <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                        @auth
                            <img 
                                src="{{ auth()->user()->avatar 
                                    ? asset('storage/' . auth()->user()->avatar) 
                                    : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                                class="w-10 h-10 rounded-full border-4 border-white shadow-lg"
                            >
                         @endauth
                </div>
                <div class="ml-3">
                <div class="text-base/5 font-medium text-white">{{ auth()->user()->name }}</div>
                <div class="text-sm font-medium text-gray-400">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                @if (auth()->user()->role == 'admin')
                    <a href="/dashboard" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Dashboard</a>
                @endif
                <form action="/logout" method="POST">
                    @csrf
                    <button onclick="return confirm('Apakah anda yakin untuk logout?')" type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</button>
                </form>
            </div>
            </div>
        </div>
    @endauth
</nav>