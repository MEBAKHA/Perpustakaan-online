<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-sky-900 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nama Peminjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Username</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Judul Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tanggal Peminjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Batas Peminjaman</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($borrows as $borrow)
                <tr>
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm">{{ $borrow->user->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $borrow->user->username }}</td>
                    <td class="px-6 py-4 text-sm">{{ $borrow->book->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ $borrow->borrow_date->format('d F Y') }}</td>
                    <td class="px-6 py-4 text-sm">{{ $borrow->due_date->format('d F Y') }}</td>
                    <td class="px-6 py-4 text-sm">
                        @if ($borrow->status == 'diajukan')
                            <span class="text-amber-600 p-1 flex items-center gap-2">
                                <i class="animate-pulse fa-solid fa-circle text-yellow-500"></i>
                                {{ $borrow->status }}
                            </span>
                        @elseif ($borrow->status == 'dipinjam')
                            <span class="text-green-600 p-1 flex items-center gap-2">
                                <i class="animate-pulse fa-solid fa-circle text-green-500"></i>
                                {{ $borrow->status }}
                            </span>
                        @elseif ($borrow->status == 'dikembalikan')
                            <span class="text-blue-600 p-1 flex items-center gap-2">
                                <i class="animate-pulse fa-solid fa-circle text-blue-500"></i>
                                {{ $borrow->status }}
                            </span>
                        @elseif ($borrow->status == 'ditolak')
                            <span class="text-red-600 p-1 flex items-center gap-2">
                                <i class="animate-pulse fa-solid fa-circle text-red-500"></i>
                                {{ $borrow->status }}
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="/borrow/detail/{{ $borrow->id }}"
                            class="bg-blue-200 px-2 py-1 rounded-lg text-blue-500 hover:bg-blue-500 hover:text-white">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-sm text-slate-600">
                        Data peminjaman belum tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $borrows->links() }}
    </div>
</div>
