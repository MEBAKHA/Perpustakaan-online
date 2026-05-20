@extends('layouts.main')

@section('konten')
    <div class="max-w-6xl mx-auto px-4 py-8">

        {{-- TITLE --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Temukan Teman
                </h1>

                <p class="text-gray-500">
                    Orang yang mungkin kamu kenal
                </p>
            </div>

            <button class="px-5 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                Lihat Semua
            </button>
        </div>

        {{-- USER LIST --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @foreach ($users as $user)

                <div class="bg-white rounded-3xl shadow-md hover:shadow-2xl transition duration-300 p-5 text-center group">

                    {{-- FOTO --}}
                    <div class="relative w-fit mx-auto">

                        <img 
                            src="{{ $user->avatar 
                                ? asset('storage/' . $user->avatar) 
                                : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                            class="w-20 h-20 rounded-full object-cover shadow-md"
                        >

                        {{-- ONLINE --}}
                        <span class="absolute bottom-1 right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full">
                        </span>

                    </div>

                    {{-- NAMA --}}
                    <h2 class="mt-4 font-bold text-lg text-gray-800">
                        {{ $user->name ?? $user->username }}
                    </h2>

                    {{-- USERNAME --}}
                    <p class="text-sm text-gray-500">
                        @ {{ $user->username }}
                    </p>

                    {{-- BUTTON --}}
                    <button class="mt-4 w-full bg-black text-white py-2 rounded-xl hover:bg-gray-800 transition">
                        <i class="fa-solid fa-heart"></i> Follow
                    </button>

                </div>

            @endforeach

        </div>

    </div>
@endsection