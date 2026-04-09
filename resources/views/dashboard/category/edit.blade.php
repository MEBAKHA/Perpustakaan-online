@extends('dashboard.layout.main')

@section('content')
<div class="grid grid-cols-12 gap-4">
  <div class="col-span-12 lg:col-span-9 p-4">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Category Form Edit</h2>
      <form action="/dashboard/category/{{ $category->slug }}" method="post" class="space-y-6">
        @csrf
        @method('PUT')
        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" name="name" id="name" value="{{ $category->name ?? old('name') }}" required
            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
          @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- Slug Field -->
        <div>
          <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
          <input type="text" name="slug" id="slug" value="{{ $category->slug ?? old('slug') }}" required
            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('slug') border-red-500 @enderror">
          @error('slug')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Edit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function () {
      const slug = nameInput.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alfanumerik
        .replace(/\s+/g, '-')         // Ganti spasi dengan tanda hubung
        .replace(/-+/g, '-');         // Ganti beberapa tanda hubung dengan satu

      slugInput.value = slug;
    });
  });
</script>
@endsection