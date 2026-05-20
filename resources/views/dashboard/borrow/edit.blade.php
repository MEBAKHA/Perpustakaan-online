@extends('dashboard.layout.main')

@section('content')
<div class="grid grid-cols-12 gap-4">
  <div class="col-span-12 lg:col-span-9 p-4">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Borrow Form</h2>
      <form action="/dashboard/borrow/{{ $borrow->id }}" method="POST" class="space-y-6">
        @method('put')
        @csrf
        <!-- user_id Field -->
        <div>
          <label for="user_id" class=" block text-sm font-medium text-gray-700">Nama Peminjam</label>
          <input type="text" value="{{ $borrow->user->name }}" disabled
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('user_id') border-red-500 @enderror">
          <input type="hidden" name="user_id" value="{{ $borrow->user_id }}">
          @error('user_id')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- book_id Field -->
        <div>
            <label for="book_id" class="block text-sm font-medium text-gray-700">Buku</label>
            <input type="text" value="{{ $borrow->book->name }}" disabled
              class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('book_id') border-red-500 @enderror">
            <input type="hidden" name="book_id" value="{{ $borrow->book_id }}">
            @error('book_id')
              <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <!-- borrow_date Field -->
        <div>
            <label for="borrow_date" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
            <input type="text" value="{{ $borrow->borrow_date->format('d M Y') }}" disabled
              class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('borrow_date') border-red-500 @enderror">
            <input type="hidden" name="borrow_date" value="{{ $borrow->borrow_date }}">
            @error('borrow_date')
              <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <!-- due_date Field -->
        <div>
            <label for="due_date" class="block text-sm font-medium text-gray-700">Deadline Peminjaman</label>
            <input type="text" value="{{ $borrow->due_date->format('d M Y') }}" disabled
              class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('due_date') border-red-500 @enderror">
            <input type="hidden" name="due_date" value="{{ $borrow->due_date }}">
            @error('due_date')
              <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <!-- description Field -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Caption Posting Ulang</label>
            <textarea name="description" id="description" rows="4" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description', $borrow->description) }}</textarea>
            @error('description')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- status Select Field -->
        <div>
            <label  for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select name="status" id="status" required
            class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value=""></option>
                <option value="diajukan" @selected(old('status', $borrow->status) == 'diajukan')>Diajukan</option>
                <option value="dipinjam" @selected(old('status', $borrow->status) == 'dipinjam')>Dipinjam</option>
                <option value="dikembalikan" @selected(old('status', $borrow->status) == 'dikembalikan')>Dikembalikan</option>
                <option value="ditolak" @selected(old('status', $borrow->status) == 'ditolak')>Ditolak</option>
            </select>
            @error('status')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
          <!-- message Field -->
        <div class="hidden" id="messageField">
          <label for="message" class=" block text-sm font-medium text-gray-700">pesan</label>
          <textarea type="text" name="message" class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('message') border-red-500 @enderror">{{ old('message', $borrow->message) }}</textarea>
          @error('message')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    const statusSelect = document.getElementById('status');
    const messageField = document.getElementById('messageField');

    function toggleMessageField() {
        if (statusSelect.value === 'ditolak') {
            messageField.classList.remove('hidden');
        } else {
            messageField.classList.add('hidden');
        }
    }

    // jalan saat halaman load
    toggleMessageField();

    // jalan saat user ganti select
    statusSelect.addEventListener('change', toggleMessageField);
</script>


@endsection