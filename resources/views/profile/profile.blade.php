@extends('layouts.main')

@section('konten')
@php
    $user = $user ?? auth()->user();
    $canEdit = $canEdit ?? auth()->check() && auth()->id() === $user->id;
    $isFollowing = $isFollowing ?? false;
@endphp

<div class="bg-gray-100 min-h-screen">

    <!-- HEADER / BANNER -->
    <div class="relative">

        <!-- Banner -->
        <img src="{{ $user?->banner ? asset('storage/' . $user->banner) : 'https://picsum.photos/1200/300' }}"
            class="w-full h-44 sm:h-60 md:h-72 object-cover">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/30"></div>

        <!-- PROFILE CONTENT -->
        <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white">

            <!-- Avatar -->
            <img src="{{ $user?->avatar ? asset('storage/' . $user->avatar) : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full border-4 border-white shadow-xl object-cover">

            <!-- Name -->
            <h1 class="mt-3 text-xl sm:text-2xl font-bold">
                {{ $user?->name ?? 'Guest' }}
            </h1>

            <!-- Username -->
            <p class="text-sm sm:text-base text-gray-200">
                @ {{ $user?->username ?? 'guest' }}
            </p>

            <!-- Stats -->
            <div class="flex gap-8 mt-4 text-center">
                <div>
                    <p class="font-bold text-lg">1</p>
                    <p class="text-xs sm:text-sm">Work</p>
                </div>

                <div>
                    <p class="font-bold text-lg">1</p>
                    <p class="text-xs sm:text-sm">Reading</p>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <div class="bg-white shadow sticky top-0 z-20">
        <div class="max-w-5xl mx-auto px-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                <!-- MENU -->
                <div class="flex overflow-x-auto no-scrollbar gap-5 text-sm sm:text-base">
                    <button class="py-4 border-b-2 border-orange-500 font-semibold whitespace-nowrap">
                        About
                    </button>

                    <button class="py-4 text-gray-500 whitespace-nowrap hover:text-black">
                        Activity
                    </button>

                    <a class="py-4 text-gray-500 whitespace-nowrap hover:text-black"
                        href="{{ route('followers', $user->username) }}">
                        {{ $user->followers->count() }} Followers
                    </a>

                    <a class="py-4 text-gray-500 whitespace-nowrap hover:text-black"
                        href="{{ route('following', $user->username) }}">
                        {{ $user->following->count() }} Following
                    </a>
                </div>

                <!-- BUTTON -->
                <div class="pb-4 md:pb-0 md:py-0">
                    @if (auth()->check() && auth()->user()->id === $user->id)

                        <a href="{{ route('profile.edit') }}"
                            class="block text-center bg-gray-200 px-5 py-2 rounded-lg text-sm hover:bg-gray-300 transition">
                            Edit Profile
                        </a>

                    @else

                        <form action="{{ route('follow', $user->id) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="w-full md:w-auto bg-blue-500 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
                                Follow
                            </button>
                        </form>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="max-w-5xl mx-auto px-4 py-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- ABOUT -->
            <div class="bg-white p-5 rounded-2xl shadow h-fit">

                <h2 class="font-bold text-lg mb-3">
                    About
                </h2>

                <p class="text-sm text-gray-700 leading-relaxed">
                    {{ $user->bio ?? 'Belum ada bio...' }}
                </p>
            </div>

            <!-- ACTIVITY -->
            <div class="md:col-span-2 space-y-4">

                @forelse ($user->stories ?? [] as $story)

                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-lg transition">

                        <h3 class="font-bold text-lg mb-2">
                            {{ $story->name }}
                        </h3>

                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit($story->body ?? 'Belum ada cerita...', 100) }}
                        </p>

                    </div>

                @empty

                    <div class="bg-white p-6 rounded-2xl shadow text-center text-gray-500">
                        Belum ada cerita...
                    </div>

                @endforelse

            </div>

        </div>
    </div>
</div>

<!-- HIDE SCROLLBAR -->
<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endsection