@extends('layouts.main')
@section('konten')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-5xl">

            @session('success')
                <p class="bg-green-100 p-4 rounded text-green-800 border border-green-300 text-sm mb-7">{{ session('success') }}</p>
            @endsession

            <!-- Header -->
            <div class="p-6 bg-sky-950 text-white text-center rounded-t-lg">
                <h1 class="text-3xl font-bold">Daftar peminjaman Buku anda</h1>
            </div>

            <!-- Content -->
            <div class="overflow-x-auto p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <!-- Table Head -->
                    <thead class="bg-sky-900 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nama Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Judul Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">tanggal peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">batas peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Action</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($borrows->count())
                            @foreach ($borrows as $borrow)
                                <!-- Row 1 -->
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{$loop->iteration}}</td>
                                    <td class="px-6 py-4 text-sm">{{$borrow->user->name}}</td>
                                    <td class="px-6 py-4 text-sm">{{$borrow->user->username}}</td>
                                    <td class="px-6 py-4 text-sm Capilatize">{{$borrow->book->name  }}</td>
                                    <td class="px-6 py-4">
                                        {{ $borrow->borrow_date->format('d F Y')}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $borrow->due_date->format('d F Y')}}
                                    </td>
                                    <td class="px-6 py-4 ">
                                        @if ($borrow->status == 'diajukan')
                                            <span class="text-amber-600 p-1 flex items-center gap-2"> 
                                                <i class=" animate-pulse fa-solid fa-circle text-yellow-500"></i> 
                                                    {{ $borrow->status }} 
                                            </span>
                                        @elseif ($borrow->status == 'dipinjam')
                                            <p class="text-green-600 p-1 flex items-center gap-2"> 
                                                <i class=" animate-pulse fa-solid fa-circle text-green-500"></i> 
                                                    {{ $borrow->status }} 
                                            </p>
                                        @elseif ($borrow->status == 'dikembalikan')
                                            <p class="text-blue-600 p-1 flex items-center gap-2"> 
                                                <i class=" animate-pulse fa-solid fa-circle text-blue-500"></i> 
                                                    {{ $borrow->status }} 
                                            </p>
                                        @elseif ($borrow->status == 'ditolak')
                                            <p class="text-red-600 p-1 flex items-center gap-2"> 
                                                <i class=" animate-pulse fa-solid fa-circle text-red-500"></i> 
                                                    {{ $borrow->status }} 
                                            </p>
                                        @endif
                                    </td>

                                    
                                    <td class="px-6 py-4">
                                        <a href="/borrow/detail/{{$borrow->id}}" class="bg-blue-200 px-2 py-1 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else  
                            <tr>
                                <td class="px-6 py-4 text-sm">data buku belum ada sihlakan pinjem buku dlu</td>
                                <button type="button" onclick="alert('yaa tinggal pinjem lah, manja amat')" class=" bg-amber-300 px-5 py-1.5 shadow-amber-400 rounded-lg">cara pinjem buku</button>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                {{-- pagination --}}
                <div class="mt-6">
                    {{ $borrows->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection