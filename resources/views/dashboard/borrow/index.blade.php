@extends('dashboard.layout.main')

@section('content')
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @session('success')
            <p class="bg-green-100 p-4 rounded text-green-800 border border-green-300 text-sm mb-7">{{ session('success') }}</p>
        @endsession
    </div>
  </div>

  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-15 p-4">
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Peminjaman
                    </th>
                    <th scope="col" class="px-6 py-3">
                        nama buku
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Date time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Due Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>

                @if ($borrows->count())
                    @foreach ($borrows as $borrow)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $borrow->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $borrow->book->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $borrow->borrow_date->format('d F Y')}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $borrow->due_date->format('d F Y')}}
                            </td>
                            <td class="px-6 py-4">
                                @if ($borrow->status == 'diajukan')
                                    <p class="text-white p-1 flex items-center gap-2"> 
                                        <i class=" animate-pulse fa-solid fa-circle text-yellow-500"></i> 
                                            {{ $borrow->status }} 
                                    </p>
                                @elseif ($borrow->status == 'dipinjam')
                                    <p class="text-white p-1 flex items-center gap-2"> 
                                        <i class=" animate-pulse fa-solid fa-circle text-green-500"></i> 
                                            {{ $borrow->status }} 
                                    </p>
                                @elseif ($borrow->status == 'dikembalikan')
                                    <p class="text-white p-1 flex items-center gap-2"> 
                                        <i class=" animate-pulse fa-solid fa-circle text-blue-500"></i> 
                                            {{ $borrow->status }} 
                                    </p>
                                @elseif ($borrow->status == 'ditolak')
                                    <p class="text-white p-1 flex items-center gap-2"> 
                                        <i class=" animate-pulse fa-solid fa-circle text-red-500"></i> 
                                            {{ $borrow->status }} 
                                    </p>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                @if ($borrow->status == 'diajukan' || $borrow->status == 'dipinjam')
                                    <div class="text-yellow-500 hover:text-yellow-600">
                                        <a href="/dashboard/borrow/{{ $borrow->id }}/edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    </div>

                                @elseif ($borrow->status == 'dikembalikan' || $borrow->status == 'ditolak') 
                                   
                                    <form action="/dashboard/borrow/{{ $borrow->id }}" method="POST" class="text-red-500 hover:text-red-600">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin?')"><i class="fa-sharp fa-solid fa-trash"></i> Delete</button>
                                    </form>

                                @endif
                            </td>
                        </tr>           
                    @endforeach
                @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td colspan="50" class="px-6 py-4 text-white text-center">
                            Belum ada data peminjaman.
                        </td>
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