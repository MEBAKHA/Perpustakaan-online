@extends('layouts.main')

@section('konten')

{{-- SEARCH --}}
<div class="max-w-3xl mx-auto mb-6 relative">

        <div class="relative w-full">
            <livewire:hall-search />
        </div>
</div>

{{-- CONTENT --}}
@if ($feed->count())

    {{-- HERO --}}
    @php $first = $feed->first(); @endphp

    <div class="relative overflow-hidden w-full shadow-lg rounded-xl">

        {{-- COVER --}}
        @if ($first instanceof \App\Models\Book)

            <img
                src="{{ $first->cover ? Storage::url($first->cover) : 'https://picsum.photos/1200/400' }}"
                class="w-full h-64 md:h-[500px] object-cover hover:scale-105 hover:opacity-90 hover:brightness-90 hover:rotate-1 transition-all duration-700 ease-in-out"
            >

        @else

            <img
                src="https://picsum.photos/1200/400?random=story"
                class="w-full h-64 md:h-[500px] object-cover"
            >

        @endif


        {{-- DARK OVERLAY --}}
        <div class="absolute inset-0 bg-black/30"></div>


        {{-- USER --}}
        <div class="absolute top-4 left-4 z-20">

            @if(auth()->check() && $first->user && $first->user->id == auth()->user()->id)

                <a wire:navigate href="/profile"
                    class="flex items-center gap-3 bg-black/50 backdrop-blur-md px-4 py-2 rounded-full hover:bg-black/70 transition">

            @else

                <a wire:navigate href="/profile/{{ $first->user->username }}"
                    class="flex items-center gap-3 bg-black/50 backdrop-blur-md px-4 py-2 rounded-full hover:bg-black/70 transition">

            @endif

                <img
                    src="{{ $first->user && $first->user->avatar
                        ? asset('storage/' . $first->user->avatar)
                        : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                    class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md"
                >

                <span class="text-white font-semibold text-sm md:text-base">
                    {{ $first->user->name ?? 'Unknown User' }}
                </span>

            </a>
        </div>


        {{-- DESKTOP CONTENT --}}
        <div class="hidden md:flex absolute inset-0 z-10 items-center justify-center text-center px-6">

            <div>

                <h3 class="text-4xl font-bold text-white drop-shadow-lg max-w-3xl mx-auto">

                    @if ($first instanceof \App\Models\Book)

                        <a href="/hall/book/{{ $first->slug }}">
                            {{ $first->name }}
                        </a>

                    @else

                        ✍️ {{ $first->title }}

                    @endif

                </h3>

                <p class="text-gray-200 mt-4 max-w-2xl mx-auto text-lg">

                    @if ($first instanceof \App\Models\Book)

                        {{ \Illuminate\Support\Str::limit($first->body, 150) }}

                    @else

                        {{ \Illuminate\Support\Str::limit($first->content, 150) }}

                    @endif

                </p>

                <a  wire:navigate href="/hall/book/{{ $first->slug }}"
                    class="mt-6 inline-block text-lg text-blue-900 bg-blue-300 py-4 px-10 hover:bg-blue-700 hover:text-white hover:px-14 hover:scale-105 hover:rounded-4xl transition-all duration-500">

                    Read more →

                </a>

            </div>

        </div>


        {{-- MOBILE TITLE ONLY --}}
        <div class="absolute bottom-4 left-4 right-4 md:hidden z-20">

            <h3 class="text-lg font-bold text-white drop-shadow-lg line-clamp-2">

                @if ($first instanceof \App\Models\Book)

                    <a href="/hall/book/{{ $first->slug }}">
                        {{ $first->name }}
                    </a>

                @else

                    ✍️ {{ $first->title }}

                @endif

            </h3>

        </div>

    </div>

    <br>

    {{-- GRID --}}
    <div class="max-w-full mx-auto px-2">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach ($feed->skip(1) as $book)

                {{-- BOOK --}}
                @if ($book instanceof \App\Models\Book)

                    <div
                        class="group bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg hover:scale-105 hover:bg-black hover:px-4 hover:py-4 transition-all duration-700">

                        <a href="/hall/book/{{ $book->slug }}">

                            <img
                                src="{{ $book->cover ? Storage::url($book->cover) : 'https://picsum.photos/400' }}"
                                class="w-full h-56 object-cover"
                            >

                        </a>

                        <div class="p-4">

                            <h5
                                class="text-lg font-bold text-gray-800 group-hover:text-white transition-colors duration-700">

                                {{ $book->name }}

                            </h5>

                            <p
                                class="text-sm text-gray-600 mt-2 group-hover:text-gray-200 transition-colors duration-700 line-clamp-4">

                                {{ \Illuminate\Support\Str::limit($book->body, 100) }}

                            </p>

                            <a wire:navigate href="/hall/book/{{ $book->slug }}"
                                class="mt-3 inline-block text-sm text-blue-900 bg-blue-300 py-2 px-4 hover:bg-blue-700 hover:text-white hover:px-8 hover:scale-105 hover:rounded-4xl transition-all duration-500">

                                Read more →

                            </a>

                        </div>

                    </div>

                {{-- STORY --}}
                @else

                    <div
                        class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">

                        <a href="">

                            <img
                                src="https://picsum.photos/400?random={{ $loop->index }}"
                                class="w-full h-56 object-cover"
                            >

                        </a>

                        <div class="p-4">

                            <h5 class="text-lg font-bold text-gray-800">

                                ✍️ {{ $book->title }}

                            </h5>

                            <p class="text-sm text-gray-600 mt-2 line-clamp-4">

                                {{ \Illuminate\Support\Str::limit($book->content, 100) }}

                            </p>

                            <span class="text-xs text-gray-500 block mt-2">

                                by {{ $book->user->name ?? 'User' }}

                            </span>

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    </div>

@else

    <p class="text-center text-gray-600 mt-20">
        Tidak ada data sama sekali...
    </p>

@endif


@endsection