@extends('layouts.main')

@section('konten')

     {{-- SEARCH --}}
    <div class="max-w-3xl mx-auto mb-6 relative">

            <div class="relative w-full">
                <livewire:hall-search />
            </div>
    </div>

        {{-- ALERT --}}
        @if (session('success'))
            <div class="max-w-3xl mx-auto mt-5 px-4">
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- CONTENT --}}
        <div class="max-w-3xl mx-auto py-6 px-4 space-y-6">

            @if ($reposts->count())

                @foreach ($reposts as $repost)

                    <div
                        class="bg-white rounded-3xl shadow-sm border overflow-hidden hover:shadow-lg transition duration-300">

                        {{-- HEADER POST --}}
                        <div class="flex items-center justify-between p-5">

                            <div class="flex items-center gap-4">

                                {{-- FOTO PROFILE --}}
                                <img src="{{ $repost->user->avatar
                                    ? asset('storage/' . $repost->user->avatar)
                                    : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                                    class="w-16 h-16 rounded-full object-cover shadow-md">

                                {{-- USER --}}
                                <div>

                                    <h2 class="font-bold text-gray-800 text-lg">
                                        {{ $repost->user->name }}
                                    </h2>

                                    <p class="text-sm text-gray-500">
                                        {{ '@' . $repost->user->username }}
                                    </p>

                                </div>

                            </div>

                            {{-- ICON REPOST --}}
                            <div
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-xs font-semibold flex items-center gap-2">

                                <i class="fa-solid fa-repeat"></i>

                                Posting Ulang

                            </div>

                        </div>

                        {{-- COVER --}}
                        <div class="relative">

                            <img src="{{ $repost->book->cover
                                ? Storage::url($repost->book->cover)
                                : 'https://picsum.photos/1200/400' }}"
                                class="w-full h-full object-cover">

                            {{-- OVERLAY --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                            </div>

                            {{-- JUDUL --}}
                            <div class="absolute bottom-0 left-0 p-5 text-white">

                                <h2 class="text-3xl font-bold capitalize">
                                    {{ $repost->book->name }}
                                </h2>

                                <p class="text-sm text-gray-200 mt-1">

                                    Diposting ulang
                                    {{ $repost->created_at->diffForHumans() }}

                                </p>

                            </div>

                        </div>

                        {{-- BODY --}}
                        <div class="p-5">

                            <div class="prose max-w-none text-gray-700">

                                {!! Str::limit($repost->book->body, 200) !!}

                            </div>

                            {{-- ACTION --}}
                            <div class="flex flex-wrap items-center justify-between gap-3 mt-5 border-t pt-4">

                                <div class="flex items-center gap-4 text-gray-500">

                                    {{-- LIKE --}}
                                    <button class="hover:text-red-500 transition">

                                        <i class="fa-regular fa-heart text-xl"></i>

                                    </button>

                                    {{-- REPOST --}}
                                    <button class="hover:text-green-500 transition">

                                        <i class="fa-solid fa-repeat text-xl"></i>

                                    </button>

                                    {{-- SHARE --}}
                                    <button class="hover:text-sky-500 transition">

                                        <i class="fa-solid fa-share text-xl"></i>

                                    </button>

                                </div>

                                <div class="flex items-center gap-3">

                                    {{-- HAPUS REPOST --}}
                                    @auth

                                        @if (auth()->id() === $repost->user_id)

                                            <form action="/repost/{{ $repost->id }}" method="POST"
                                                onsubmit="return confirm('Batalkan posting ulang ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full text-sm transition">

                                                    Batal

                                                </button>

                                            </form>

                                        @endif

                                    @endauth

                                    {{-- DETAIL --}}
                                    <a href="/hall"
                                        class="bg-sky-900 hover:bg-sky-800 text-white px-5 py-2 rounded-full text-sm transition">

                                        lihat content

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            @else

                {{-- EMPTY --}}
                <div class="bg-white rounded-3xl shadow-sm border p-10 text-center">

                    <div class="text-7xl text-gray-300 mb-5">

                        <i class="fa-solid fa-repeat"></i>

                    </div>

                    <h2 class="text-3xl font-bold text-gray-700">

                        Belum Ada Posting Ulang dari kamu wahai {{ auth()->user()->name }} 

                    </h2>

                    <p class="text-gray-500 mt-3">

                        Posting ulang Content Menarik favorit kamu 🔁

                    </p>

                    <a href="/hall"
                        class="inline-block mt-6 bg-sky-900 hover:bg-sky-800 text-white px-6 py-3 rounded-full transition shadow">

                        Jelajahi Content

                    </a>

                </div>

            @endif

            {{-- PAGINATION --}}
            <div class="pt-6">

                {{ $reposts->links() }}

            </div>

        </div>

    </div>
@endsection