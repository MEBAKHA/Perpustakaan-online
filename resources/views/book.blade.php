@extends('layouts.main')

@section('konten')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-8">
            <h2 class="text-3xl font-bold mb-2 capitalize">{{ $book->name }}</h2>

            <p class="text-gray-600 text-sm">
               <a href="#" class="flex items-center gap-3 text-blue-600 hover:underline">
                    <img src="{{ $book->author->avatar ? asset('storage/' . $book->author->avatar) : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                        class="w-10 h-10 rounded-full object-cover shadow-md">

                    <span class="text-gray-800 hover:text-blue-600 transition">
                        {{ $book->author->name }}
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
            <div class=" flex justify-between items-center">
                <a href="/hall" class="inline-block text-blue-500 hover:underline mt-4">← Back to blog</a>
                @auth
                    @if ($book->status == 1)
                        <a href="" onclick="alert('buku sedang di pinjamkan')"
                            class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            <i class="fa-solid fa-book-open-reader"></i>
                            Pinjam Buku
                        </a>
                    @else
                        <form action="/borrow" method="POST">
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @csrf
                            <button type="submit"
                                class=" inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="fa-solid fa-book-open-reader"></i>
                                Pinjam Buku
                            </button>
                        </form>
                    @endif
                @else
                    <a href="/login"
                        class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        <i class="fa-solid fa-book-open-reader"></i>
                        Pinjam Buku
                    </a>


                @endauth

            </div>
        </div>
    </div>
@endsection
