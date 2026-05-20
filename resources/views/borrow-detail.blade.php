@extends('layouts.main')

@section('konten')

<div class="max-w-4xl mx-auto py-8 px-4">

    <h1 class="text-3xl font-bold mb-8">
        🔁 Posting Ulang
    </h1>

    <div class="space-y-6">

        @forelse ($reposts as $repost)

            <div class="bg-white rounded-3xl shadow border overflow-hidden">

                {{-- HEADER --}}
                <div class="p-5 flex items-center gap-4">

                    <img
                        src="{{ $repost->user->avatar
                            ? asset('storage/' . $repost->user->avatar)
                            : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                        class="w-14 h-14 rounded-full object-cover">

                    <div>

                        <h2 class="font-bold text-lg">
                            {{ $repost->user->name }}
                        </h2>

                        <p class="text-gray-500 text-sm">
                            {{ '@'.$repost->user->username }}
                        </p>

                    </div>

                </div>

                {{-- COVER --}}
                @if ($repost->book->cover)

                    <img
                        src="{{ Storage::url($repost->book->cover) }}"
                        class="w-full h-[400px] object-cover">

                @endif

                {{-- CONTENT --}}
                <div class="p-5">

                    <div class="flex items-center gap-2 text-green-600 mb-3">

                        <i class="fa-solid fa-repeat"></i>

                        <span class="text-sm">
                            Memposting ulang buku ini
                        </span>

                    </div>

                    <h1 class="text-2xl font-bold capitalize mb-3">
                        {{ $repost->book->name }}
                    </h1>

                    <div class="prose max-w-none text-gray-700">

                        {!! Str::limit($repost->book->body, 200) !!}

                    </div>

                    <div class="mt-5 flex items-center justify-between">

                        <p class="text-sm text-gray-400">
                            {{ $repost->created_at->diffForHumans() }}
                        </p>

                        <a
                            href="/hall/book/{{ $repost->book->slug }}"
                            class="bg-sky-900 hover:bg-sky-800 text-white px-4 py-2 rounded-full text-sm">

                            Lihat Buku

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-3xl p-10 text-center shadow">

                <h2 class="text-2xl font-bold">
                    Belum ada repost 🔁
                </h2>

            </div>

        @endforelse

    </div>

    <div class="mt-8">
        {{ $reposts->links() }}
    </div>

</div>

@endsection