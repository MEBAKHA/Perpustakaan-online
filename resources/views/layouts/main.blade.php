<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>HOREAMPEDIA | {{ $title ?? 'Dashboard' }}</title>

    {{-- Alpine JS --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Font Inter --}}
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('img/image.png') }}" type="image/x-icon">

    {{-- Tailwind / Vite --}}
    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    {{-- Livewire Styles --}}
    @livewireStyles

    {{-- Prefetch Navigation --}}
    <meta name="turbo-prefetch" content="true">
</head>

<body class="h-full font-sans antialiased bg-gray-100 text-gray-900">

    <div class="min-h-screen flex flex-col">

        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Header --}}
        @include('partials.header')

        {{-- Content --}}
        <main class="flex-1">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

                @yield('konten')

            </div>
        </main>

        {{-- Footer --}}
        @include('partials.footer')

    </div>

    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- LIVEWIRE PAGE TRANSITION LOADING BAR --}}
    @persist('livewire-loading')

    <div
        x-data="{ loading: false }"

        x-on:livewire:navigate-start.window="
            loading = true
        "

        x-on:livewire:navigate-finish.window="
            loading = false
        "

        x-show="loading"

        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"

        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"

        class="fixed top-0 left-0 w-full z-[999999]"
    >

        <div
            class="h-1 bg-blue-500 animate-pulse w-full shadow-lg shadow-blue-500/50"
        ></div>

    </div>

    @endpersist

</body>
</html>