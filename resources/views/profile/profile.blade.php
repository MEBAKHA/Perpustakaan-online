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
        <img src="{{ $user?->banner ? asset('storage/' . $user->banner) : 'https://picsum.photos/1200/300' }}"
            class="w-full h-40 sm:h-56 md:h-72 object-cover">

        <!-- PROFILE -->
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white px-4 text-center">

            <img src="{{ $user?->avatar ? asset('storage/' . $user->avatar) : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full border-4 border-white shadow-lg">

            <h1 class="text-lg sm:text-xl md:text-2xl font-bold mt-3 bg-white/80 px-3 py-1 text-black rounded">
                {{ $user?->name ?? 'Guest' }}
            </h1>

            <p class="text-xs sm:text-sm bg-white/80 px-3 py-1 text-black rounded-2xl mt-2">
                @ {{ $user?->username ?? 'guest' }}
            </p>

            <div class="flex gap-6 sm:gap-8 mt-4 text-center text-xs sm:text-sm">
                <div>
                    <p class="font-bold">1</p>
                    <p>Work</p>
                </div>
                <div>
                    <p class="font-bold">1</p>
                    <p>Reading</p>
                </div>
            </div>
        </div>
    </div>

    <!-- NAV -->
    <div class="bg-white shadow">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between px-4">

            <!-- MENU -->
            <div class="flex overflow-x-auto gap-4 sm:gap-6 text-sm sm:text-base">
                <button class="py-3 border-b-2 border-orange-500 font-semibold whitespace-nowrap">
                    About
                </button>

                <button class="py-3 text-gray-500 whitespace-nowrap">
                    Activity
                </button>

                <a class="py-3 text-gray-500 whitespace-nowrap"
                   href="{{ route('followers', $user->username) }}">
                    {{ $user->followers->count() }} Followers
                </a>

                <a class="py-3 text-gray-500 whitespace-nowrap"
                   href="{{ route('following', $user->username) }}">
                    {{ $user->following->count() }} Following
                </a>
            </div>

            <!-- BUTTON -->
            <div class="mt-3 md:mt-0">
                @if (auth()->check() && auth()->user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}"
                       class="block text-center bg-gray-200 px-4 py-2 rounded-md text-sm hover:bg-gray-300">
                        Edit Profile
                    </a>
                @else
                    <form action="{{ route('follow', $user->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full md:w-auto bg-blue-500 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-600">
                            Follow
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="max-w-5xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-6 px-4">

        <!-- ABOUT -->
        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="font-semibold mb-2">About</h2>

            <p class="text-sm text-gray-700 leading-relaxed">
                {{ $user->bio ?? 'Belum ada bio...' }}
            </p>
        </div>

        <!-- ACTIVITY -->
        <div class="md:col-span-2 space-y-4">
            @foreach ($user->stories as $story)
                <div class="bg-white p-4 rounded shadow mb-3">
                    <h3 class="font-bold">{{ $story->title }}</h3>
                    <p class="text-sm text-gray-600">{{ Str::limit($story->content, 100) ?? 'Belum ada cerita...' }}</p>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection