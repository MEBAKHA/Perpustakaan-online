@extends('layouts.main')

@section('konten')
    {{-- Search Section --}}
    <div class="max-w-3xl mx-auto mb-6">
        <form action="/hall" method="get" class="flex items-center bg-white shadow-md rounded-lg overflow-hidden">
            <input
                name="search" 
                type="text"  
                class="w-full px-4 py-2 text-gray-700 focus:outline-none" 
                placeholder="Cari buku..." 
                value="{{ request('search') }}"
                autocomplete="off"
            />
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 hover:bg-blue-600">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>
    </div>

    @if ($books->count())
        <!-- Hero Section -->
        <div class="max-w-4xl mx-auto mb-18">
            <div class="overflow-hidden rounded-lg shadow-lg max-h-100">
                @if ($books[0]->cover)
                    <img src="{{ Storage::url($books[0]->cover) }}" alt="Cover Buku" class="w-full h-96 object-cover">
                @else
                    <img src="https://picsum.photos/1200/400" alt="Cover Buku" class="w-full h-96 object-cover">
                @endif
            </div>

            <div class="text-center mt-4">
                <h3 class="text-2xl font-bold">
                    <a href="/hall/book/{{ $books[0]->slug }}" class="text-gray-900 hover:text-blue-500 capitalize">
                        {{ $books[0]->name }}
                    </a>
                </h3>

                <div class="flex justify-center items-center text-gray-600 text-sm gap-4 mt-2">
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-user text-blue-600"></i>
                        <a href="/hall?author={{ $books[0]->author->slug }}" class="hover:text-blue-500">{{ $books[0]->author->name }}</a>
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-bookmark text-green-500"></i>
                        <a href="/hall?category={{ $books[0]->category->slug }}" class="hover:text-blue-500">{{ $books[0]->category->name }}</a>
                    </span>
                    <span class="flex items-center gap-1">
                        <i class="fa-solid fa-clock text-yellow-300"></i>
                        {{ optional($books[0]->published_at)->diffForHumans() ?? 'Belum terbit' }}
                    </span>
                </div>

                <p class="text-gray-700 mt-2">
                    {{ Str::limit($books[0]->body, 150) }}
                </p>

                <a
                    href="/hall/book/{{ $books[0]->slug }}"
                    class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                    Read more
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($books->skip(1) as $book)
                    <!-- Card -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="relative">
                            @if ($book->cover)
                                <img src="{{ Storage::url($book->cover) }}" class="w-full h-60 object-cover" alt="Book Cover">
                            @else
                                <img src="https://picsum.photos/400/400?random=1" class="w-full h-60 object-cover" alt="Book Cover">
                            @endif
                            <div class="absolute top-2 left-2 bg-black/70 text-white px-3 py-1 text-xs rounded">
                                <a href="/hall?category={{ $book->category->slug }}" class="hover:underline">{{ $book->category->name }}</a>
                            </div>
                        </div>
                        <div class="p-4">
                            <h5 class="text-lg font-bold">
                                <a href="/hall/book/{{ $book->slug }}" class="hover:text-blue-500 capitalize">{{ $book->name }}</a>
                            </h5>
                            <div class="flex items-center text-gray-600 text-sm gap-4 mt-2">
                                <span class="flex items-center gap-1">
                                    <i class="fa-solid fa-user text-blue-600"></i>
                                    <a href="/hall?author={{ $book->author->slug }}" class="hover:text-blue-500">{{ $book->author->name }}</a>
                                </span>
                                <span class="flex items-center gap-1">
                                    <i class="fa-solid fa-clock text-yellow-300"></i>
                                    {{ optional($book->published_at)->diffForHumans() ?? 'Belum terbit' }}
                                </span>
                            </div>
                            <p class="text-gray-700 mt-2">
                                {{ Str::limit($book->body, 150) }}
                            </p>
                            <a href="/hall/book/{{ $book->slug }}" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Read more
                            </a>
                        </div>
                    </div>
                    {{-- card penutup --}}
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center text-gray-600 mt-25">Tidak ada data buku.</p>
    @endif


    {{-- pagination --}}
    <div class="mt-6">
        {{ $books->links() }}
    </div>
@endsection