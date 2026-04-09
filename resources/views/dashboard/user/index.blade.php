@extends('dashboard.layout.main')

@section('content')
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-9 p-4">
        @session('success')
            <p class="bg-green-100 p-4 rounded text-green-800 border border-green-300 text-sm mb-7">{{ session('success') }}</p>
        @endsession
        <a href="/dashboard/user/create" class="px-5 py-3 bg-sky-300 rounded-md text-gray-500 hover:bg-sky-400 transition">Tambah user</a>
    </div>
  </div>

  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-12 p-4">
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Pengguna
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Slug
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-400">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->slug }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->username }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->role }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <form action="/dashboard/user/{{ $user->slug }}" method="POST" class="text-red-500 hover:text-red-600">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Apakah anda yakin?')"><i class="fa-sharp fa-solid fa-trash"></i> Delete</button>
                            </form>
                            <p>|</p>
                            <div class="text-yellow-500 hover:text-yellow-600">
                                <a href="/dashboard/user/{{ $user->slug }}/edit"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </div>
                        </td>
                    </tr>           
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection	