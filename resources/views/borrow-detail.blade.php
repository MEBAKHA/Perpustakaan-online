@extends('layouts.main')

@section('konten')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-5xl p-4 my-10">
            
            <h1 class="text-center text-2xl mb-4">
                Detail Tiket Peminjaman ID: {{ $borrow->id }}
            </h1>
            <hr>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:p-4">

                <!-- Grid 1 -->
                <div class="bg-white md:p-6 rounded">
                    <h2 class="text-lg font-bold mb-4">Detail Peminjaman</h2>
                    @if ($borrow->status == "diajukan")
                        <span class="px-2 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 capitalize">{{ $borrow->status }}</span>
                    @elseif ($borrow->status == "dipinjam")
                        <span class="px-2 text-xs font-semibold rounded-full bg-green-100 text-green-800 capitalize">{{ $borrow->status }}</span>
                    @elseif ($borrow->status == "dikembalikan")
                        <span class="px-2 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 capitalize">{{ $borrow->status }}</span>
                    @elseif ($borrow->status == "ditolak")
                        <span class="px-2 text-xs font-semibold rounded-full bg-red-100 text-red-800 capitalize">{{ $borrow->status }}</span>
                    @endif
                </div>

                <!-- Grid 2 -->
                <div class="bg-white md:p-6 rounded"></div>

                <!-- Grid 3 -->
                <div class="bg-white md:p-6 rounded">
                    <h2 class="text-lg font-bold mb-4">Detail Buku</h2>

                    <div class="space-y-2 text-sm">
                        <div class="flex">
                            <div class="w-40">Judul</div>
                            <div class="font-semibold capitalize">{{ $borrow->book->name }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-40">Penulis</div>
                            <div class="font-semibold">{{ $borrow->book->author->name }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-40">Tanggal Terbit</div>
                            <div class="font-semibold">{{ $borrow->book->published_at ? $borrow->book->published_at->format('d M Y') : "Belum terbit" }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-40">Cover</div>
                            <div class="font-semibold"></div>
                        </div>
                        @if ($borrow->book->cover)
                            <img src="{{ Storage::url($borrow->book->cover) }}" alt="">
                        @else
                            <img src="https://picsum.photos/300?random=10" class="rounded shadow">
                        @endif
                    </div>
                </div>

                <!-- Grid 4 -->
                <div class="bg-white md:p-6 rounded">
                    <h2 class="text-lg font-bold mb-4">Detail Peminjam</h2>

                    <div class="space-y-2 text-sm">
                        <div class="flex">
                            <div class="w-40">Nama</div>
                            <div class="font-semibold">{{ $borrow->user->name }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-40">Email</div>
                            <div class="font-semibold">{{ $borrow->user->email }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-40">Role</div>
                            <div class="font-semibold">{{ $borrow->user->role }}</div>
                        </div>
                    </div>

                    <!-- Pesan -->
                    @isset ($borrow->message)
                        <h2 class="text-lg font-bold mt-10 mb-3">Pesan</h2>

                        <div class="flex items-start gap-3 mb-4 bg-sky-50 p-4 rounded-lg">
                            
                            <!-- Foto Profil -->
                            <img 
                                src="https://picsum.photos/40?random=20" 
                                class="rounded-full w-10 h-10 object-cover"
                            >

                            <!-- Bubble Chat -->
                            <div class="max-w-md">
                                
                                <!-- Nama -->
                                <p class="text-sm font-semibold text-gray-800 mb-1">
                                    Admin Perpustakaan
                                </p>

                                <!-- Bubble -->
                                <div class="bg-gray-50 rounded-xl px-4 py-2 text-sm text-gray-700 shadow-sm">
                                    {{ $borrow->message }}
                                </div>

                                <!-- Timestamp (optional) -->
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $borrow->updated_at->format('H:i') }} WIB
                                </p>

                            </div>
                        </div>
                    @endisset
                </div>

                <!-- Grid 5 -->
                <div class="bg-white md:p-6 rounded"></div>

                <!-- Grid 6 -->
                <div class="bg-white md:p-6 rounded"></div>

                <!-- Grid 7 -->
                <div class="bg-white md:p-6 rounded"></div>

                <!-- Grid 8 -->
                <div class="bg-white md:p-6 rounded"></div>

            </div>
        </div>
    </div>
@endsection