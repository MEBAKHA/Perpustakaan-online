{{-- @dd($title) --}}
@extends('layouts.main')

@section('konten')

<section class="py-10 min-h-screen">

    <div class="max-w-5xl mx-auto px-4">
        {{-- FEED --}}
        <div class="space-y-8">

            @foreach ($books as $book)

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 pb-4">

                    {{-- USER --}}
                    <div class="flex items-center justify-between p-5">

                        <div class="flex items-center gap-3">

                            {{-- AVATAR --}}
                            <img src="{{ $book->user && $book->user->avatar 
                                ? asset('storage/' . $book->user->avatar) 
                                : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                                class="w-10 h-10 rounded-full object-cover shadow-md">

                            <div>
                                <h3 class="font-semibold text-gray-900">
                                    {{ $book->user->name }}
                                </h3>
                                
                                <p class="text-xs text-gray-500">
                                    @ {{ $book->user->username }}
                                </p>

                                <p class="text-xs text-gray-500">
                                   <i class="fa-regular fa-clock"></i> {{ $book->created_at->diffForHumans() }}
                                </p>
                            </div>

                        </div>
    
                        
                        <button class="text-gray-400 text-2xl">
                            ⋮
                        </button>


                    </div>

                    {{-- COVER --}}
                    <a href="/hall/book/{{ $book->slug }}">

                        @if ($book->cover)
                            <img 
                                src="{{ Storage::url($book->cover) }}" 
                                alt="{{ $book->name }}"
                                class="w-full h-full object-cover"
                            >
                        @else
                            <img 
                                src="https://picsum.photos/1200/600"
                                alt="{{ $book->name }}"
                                class="w-full h-full object-cover"
                            >
                        @endif

                    </a>

                    {{-- CONTENT --}}
                    <div class="p-6">

                        {{-- ACTION --}}
                        <div class="flex items-center gap-5 text-2xl mb-5">
                          <i class="fa-regular fa-star"></i>
                          <i class="fa-solid fa-share"></i>
                          <i class="fa-solid fa-comment"></i>
                          <i class="fa-solid fa-repeat"></i>
                        </div>

                          
                        
                        {{-- CATEGORY --}}
                        <span class="inline-flex px-4 py-2 text-xs font-semibold tracking-widest uppercase rounded-full {{ $book->category_color }}">
                            {{ $book->category->name }}
                        </span>

                        {{-- TITLE --}}
                        <h2 class="mt-5 text-3xl font-bold text-gray-900 capitalize">
                            <a href="/hall/book/{{ $book->slug }}">
                                {{ $book->name }}
                            </a>
                        </h2>

                        {{-- BODY --}}
                        <p class="mt-4 text-gray-600 leading-relaxed">
                            {{ Str::limit($book->body, 180) }}
                        </p>
                        <br>
                        <br>

                        @auth

                            <a
                            wire:navigate 
                            class=" bg-blue-400 shadow shadow-blue-200 text-cyan-50 px-4 py-3 hover:bg-blue-600 hover:text-white hover:shadow-2xl hover:py-4 transition-all duration-500 font-semibold text-lg focus:outline-none focus:shadow-outline" 
                            href=" /hall/book/{{ $book->slug }}"> <i class="fa-solid fa-eye mr-2"></i> Lihat Selengkapnya </a> 
                        
                            
                        @else

                            <a
                            wire:navigate 
                            class=" bg-red-600 text-cyan-50 py-4 px-3" onclick=" return confirm('apakah anda ingin membuka lebih lengkap dan detail? tolong login terlebih dahulu')"
                            href="/login"> <i class="fa-solid fa-eye mr-2"></i> Lihat Selengkapnya </a> 
                            
                        @endauth


                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection