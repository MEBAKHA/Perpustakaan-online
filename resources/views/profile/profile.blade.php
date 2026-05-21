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

            <!-- Banner -->
            <img src="{{ $user?->banner ? asset('storage/' . $user->banner) : 'https://picsum.photos/1200/300' }}"
                class="w-full h-44 sm:h-60 md:h-72 object-cover">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/30"></div>

            <!-- PROFILE CONTENT -->
            <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center text-white">

                <!-- Avatar -->
                <img src="{{ $user?->avatar ? asset('storage/' . $user->avatar) : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}"
                    class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full border-4 border-white shadow-xl object-cover">

                <!-- Name -->
                <h1 class="mt-3 text-xl sm:text-2xl font-bold">
                    {{ $user?->name ?? 'Guest' }}
                </h1>

                <!-- Username -->
                <p class="text-sm sm:text-base text-gray-200">
                    @ {{ $user?->username ?? 'guest' }}
                </p>
            </div>
        </div>

        <!-- NAVBAR -->
        <div class="bg-white shadow sticky top-0 z-20">
            <div class="max-w-5xl mx-auto px-4">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                    <!-- MENU -->
                    <div class="flex overflow-x-auto no-scrollbar gap-5 text-sm sm:text-base">
                        <button class="py-4 text-gray-500 font-semibold whitespace-nowrap  hover:text-black">
                            About
                        </button>

                        <button class="py-4 text-gray-500 whitespace-nowrap hover:text-black">
                            Activity
                        </button>

                        <a class="py-4 text-gray-500 whitespace-nowrap hover:text-black"
                            href="{{ route('followers', $user->username) }}">
                            {{ $user->followers->count() }} Followers
                        </a>

                        <a class="py-4 text-gray-500 whitespace-nowrap hover:text-black"
                            href="{{ route('following', $user->username) }}">
                            {{ $user->following->count() }} Following
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <div class="pb-4 md:pb-0 md:py-0">
                        @if (auth()->check() && auth()->user()->id === $user->id)
                            <a href="{{ route('profile.edit') }}"
                                class="block text-center bg-gray-200 px-5 py-2 rounded-lg text-sm hover:bg-gray-300 transition">
                                Edit Profile
                            </a>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="w-full md:w-auto bg-blue-500 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-heart"></i> Follow
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="max-w-5xl mx-auto px-4 py-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- ABOUT -->
                <div class="bg-white p-5 rounded-2xl shadow h-fit">

                    <h2 class="font-bold text-lg mb-3">
                        About
                    </h2>

                    <p class="text-sm text-gray-700 leading-relaxed">
                        {{ $user->bio ?? 'Belum ada bio...' }}
                    </p>
                </div>

                <!-- ACTIVITY -->
                <div class="md:col-span-2 space-y-4">

                    @if (auth()->check() && auth()->user()->id === $user->id)
                       @forelse ($user->stories ?? [] as $story)
                        <div class="bg-white bg-black p-5 rounded-2xl shadow hover:shadow-lg transition">


                            <img src="{{ $story->cover ? Storage::url($story->cover) : 'https://picsum.photos/1200/400' }}"
                                alt="">
                            <h3 class="font-bold text-lg mb-2">
                                {{ $story->name }}
                            </h3>

                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($story->body ?? 'Belum ada Content...', 100) }}
                            </p>

                            <br>
                            <div class="flex justify-center items-center mx-auto mt-4 bg-black py-3 px-4 rounded-4xl">
                                <div class="flex justify-center items-center">
                                    <form action="/story/{{ $story->slug }}" method="POST"
                                        class="text-red-500 hover:text-red-600 mr-3">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')"><i
                                                class="fa-sharp fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                    <p class="mr-3 text-white">|</p>
                                    <div class="text-yellow-500 hover:text-yellow-600">
                                        <a href="/story/{{ $story->slug }}/edit"><i class="fa-solid fa-pen-to-square"></i>
                                            Edit</a>
                                    </div>
                                    </button>
                                </div>
                            </div>

                        @empty

                            <div class="bg-white p-6 rounded-2xl shadow text-center text-gray-500">
                                Belum ada Content dari anda...
                            </div>
                        @endforelse
                    @else
                        @forelse ($user->stories ?? [] as $story)
                            <div class="bg-white bg-black p-5 rounded-2xl shadow hover:shadow-lg transition">


                                <img src="{{ $story->cover ? Storage::url($story->cover) : 'https://picsum.photos/1200/400' }}"
                                    alt="">
                                <h3 class="font-bold text-lg mb-2">
                                    {{ $story->name }}
                                </h3>

                                <p class="text-sm text-gray-600 leading-relaxed">
                                    {{ \Illuminate\Support\Str::limit($story->body ?? 'Belum ada Content...', 100) }}
                                </p>

                                <br>
                                
                                {{-- ACTION --}}
                                <div class="flex items-center gap-5 text-2xl mb-5">
                                <i class="fa-regular fa-star"></i>
                                <i class="fa-solid fa-share"></i>
                                <i class="fa-solid fa-comment"></i>
                                <i class="fa-solid fa-repeat"></i>
                                </div>
                            </div>    

                            @empty

                                <div class="bg-white p-6 rounded-2xl shadow text-center text-gray-500">
                                    Belum ada Content dari {{ $user->name }} atau yang bisa di panggil {{ $user->username }}...
                                </div>
                        @endforelse
                    @endif

                    

                </div>

            </div>
        </div>
    </div>

    <!-- HIDE SCROLLBAR -->
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
