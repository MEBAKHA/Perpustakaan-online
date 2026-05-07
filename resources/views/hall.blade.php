@extends('layouts.main')

@section('konten')

{{-- SEARCH --}}
<div class="max-w-3xl mx-auto mb-6 relative">
    <form action="/hall" method="get"
        class="flex items-center bg-white shadow-md rounded-lg overflow-visible">

        <div class="relative w-full">
            <input
                id="searchInput"
                name="search"
                type="text"
                class="w-full px-4 py-2 text-gray-700 focus:outline-none"
                placeholder="Cari buku / story / user..."
                value="{{ request('search') }}"
                autocomplete="off"
            >

            <div id="suggestions"
                class="absolute top-full left-0 w-full bg-white shadow-md rounded-b-lg hidden z-50 border">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 hover:text-white hover:px-8 transition-all">
            <i class="fa-solid fa-search"></i>
        </button>
    </form>
</div>

{{-- CONTENT --}}
@if ($feed->count())

    {{-- HERO --}}
    @php $first = $feed->first(); @endphp

    <div class="max-w-4xl mx-auto mb-12">
        <div class="overflow-hidden w-full h-full shadow-lg">
            <a  href="/hall/book/{{ $first->slug }}">
                @if ($first instanceof \App\Models\Book)
                
                    <img  src="{{ $first->cover ? Storage::url($first->cover) : 'https://picsum.photos/1200/400' }}"
                        class="w-full h-80 object-cover hover:scale-105 hover:px-7 hover:py-7 hover:bg-black transition-all duration-1000">
                @else
                    <img src="https://picsum.photos/1200/400?random=story"
                        class="w-full h-80 object-cover">
                @endif

            </a>

        </div>

        <div class="text-center mt-4">

            <h3 class="text-2xl font-bold text-gray-800">

                @if ($first instanceof \App\Models\Book)
                    <a href="/hall/book/{{ $first->slug }}">
                         {{ $first->name }}
                    </a>
                @else
                    ✍️ {{ $first->title }}
                @endif

            </h3>

            <p class="text-gray-600 mt-2 max-w-xl mx-auto">
                @if ($first instanceof \App\Models\Book)
                    {{ \Illuminate\Support\Str::limit($first->body, 150) }}
                @else
                    {{ \Illuminate\Support\Str::limit($first->content, 150) }}
                @endif
            </p>

        </div>
    </div>

    {{-- GRID --}}
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach ($feed->skip(1) as $book)

                {{-- BOOK --}}
                @if ($book instanceof \App\Models\Book)

                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg hover:scale-105 hover:bg-blue-200 hover:px-7 hover:py-7 transition-all duration-1000 ">

                       <a href="/hall/book/{{ $book->slug }}">
                         <img src="{{ $book->cover ? Storage::url($book->cover) : 'https://picsum.photos/400' }}">
                        </a>

                        <div class="p-4">
                            <h5 class="text-lg font-bold text-gray-800">
                                {{ $book->name }}
                            </h5>

                            <p class="text-sm text-gray-600 mt-2">
                                {{ \Illuminate\Support\Str::limit($book->body, 100) }}
                            </p>

                            <a href="/hall/book/{{ $book->slug }}"
                                class="mt-3 inline-block text-sm text-blue-900 bg-blue-300 py-2 px-4 hover:bg-blue-700 hover:text-white hover:px-8 hover:py-2 hover:scale-105 hover:rounded-4xl transition-all duration-500 ">
                                Read more →
                            </a>
                        </div>

                    </div>

                {{-- STORY --}}
                @else

                    <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">

                       <a href="">
                          <img src="https://picsum.photos/400?random={{ $loop->index }}"
                            class="w-full h-56 object-cover">

                       </a>
                        <div class="p-4">
                            <h5 class="text-lg font-bold text-gray-800">
                                ✍️ {{ $book->title }}
                            </h5>

                            <p class="text-sm text-gray-600 mt-2">
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
        Tidak ada data...
    </p>
@endif


{{-- SEARCH SCRIPT --}}
<script>
const input = document.getElementById("searchInput");
const suggestions = document.getElementById("suggestions");

let timeout = null;

input.addEventListener("input", function () {
    clearTimeout(timeout);

    timeout = setTimeout(async () => {
        const query = input.value;

        if (!query) {
            suggestions.classList.add("hidden");
            return;
        }

        const res = await fetch(`/search-suggestions?q=${query}`);
        const data = await res.json();

        suggestions.innerHTML = "";

        if (data.length === 0) {
            suggestions.classList.add("hidden");
            return;
        }

        data.forEach(item => {
            const div = document.createElement("div");
            div.className = "px-4 py-2 hover:bg-gray-100 cursor-pointer";
            div.textContent = item;

            div.onclick = () => {
                input.value = item;
                suggestions.classList.add("hidden");
            };

            suggestions.appendChild(div);
        });

        suggestions.classList.remove("hidden");
    }, 300);
});
</script>

@endsection