@extends('layouts.main')

@section('konten')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-2 capitalize">{{ $book->name }}</h2>

            <p class="text-gray-600 text-sm">
                @if (auth()->check() && $book->user && $book->user->id == auth()->user()->id)
                    <a href="/profile" class="flex items-center gap-3 text-blue-600 hover:underline">
                    @else
                        <a href="/profile/{{ $book->user->username }}"
                            class="flex items-center gap-3 text-blue-600 hover:underline">
                @endif

                <img src="{{ $book->user && $book->user->avatar
                    ? asset('storage/' . $book->user->avatar)
                    : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                    class="w-10 h-10 rounded-full object-cover shadow-md">

                <span class="text-gray-800 hover:text-blue-600 transition">
                    {{ $book->user->name ?? 'Unknown User' }}
                </span>

                </a>
            </p>
            <br>
            <br>

            @if ($book->cover)
                <img src="{{ Storage::url($book->cover) }}" alt="" class="w-full object-cover rounded-md">
            @else
                <img src="https://picsum.photos/1200/400" alt="" class="w-full object-cover rounded-md">
            @endif

            <article class="prose max-w-none my-6">
                {!! $book->body !!}
            </article>
                @php
                    $sudahRepost = $book->reposts
                        ->where('user_id', auth()->user()->id)
                        ->count();
                @endphp

                <form action="{{ url('/books/' . $book->id . '/repost') }}" method="POST">
                    @csrf

                    @if ($sudahRepost)

                        <button
                            type="submit"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">

                            <i class="fa-solid fa-repeat"></i>
                            Sedang Memposting Ulang

                        </button>

                    @else

                        <button
                            type="submit"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">

                            <i class="fa-solid fa-repeat"></i>
                            Posting Ulang

                        </button>

                    @endif
                </form>
        </div>
    </div>
@endsection
