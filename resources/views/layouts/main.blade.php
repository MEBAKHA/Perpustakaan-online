<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Library | {{ $title }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    @vite('resources/css/app.css')

    {{-- cdn font awesome --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/all.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/sharp-thin.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/sharp-solid.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/sharp-regular.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/sharp-light.css" />
</head>
<body class="h-full">
    <div class="min-h-full">
        @include('partials.navbar')

        @include('partials.header')

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <!-- Your content -->
                @yield('konten')
            </div>
        </main>
    </div>
  
</body>
</html>