<div class="space-y-4 mb-8">
    @if ($successMessage)
        <div class="rounded-lg bg-emerald-100 border border-emerald-200 text-emerald-900 p-4 text-sm">
            {{ $successMessage }}
        </div>
    @endif

    @guest
        <a href="/login"
            class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            <i class="fa-solid fa-book-open-reader"></i>
            Pinjam Buku
        </a>
    @else
        @if ($book->status == 1)
            <button type="button"
                class="inline-flex items-center gap-2 rounded-md bg-slate-400 px-4 py-2 font-semibold text-white shadow cursor-not-allowed"
                disabled>
                <i class="fa-solid fa-book-open-reader"></i>
                Buku Sedang Dipinjam
            </button>
        @else
            <button type="button" wire:click="borrowBook" wire:loading.attr="disabled"
                class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white shadow hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                <i class="fa-solid fa-book-open-reader"></i>
                Pinjam Buku
            </button>
        @endif
    @endguest
</div>
