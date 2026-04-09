@extends('dashboard.layout.main')

@section('content')
<div class="grid grid-cols-12 gap-4">
  <div class="col-span-12 lg:col-span-9 p-4">
    <div class="bg-white p-6 rounded-lg shadow">
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Book Form</h2>
      <form action="/dashboard/book" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        <!-- Name Field -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
          @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- Slug Field -->
        <div>
          <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
          <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('slug') border-red-500 @enderror">
          @error('slug')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>
        <!-- Body Field -->
        <div>
            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
            <textarea name="body" id="body" rows="4" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('body') border-red-500 @enderror">{{ old('body', $book->body ?? '') }}</textarea>
            @error('body')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Published At Field -->
        <div>
            <label for="published_at" class="block text-sm font-medium text-gray-700">Published At</label>
            <input type="datetime-local" name="published_at" id="published_at"
            value="{{ old('published_at', isset($book->published_at) ? $book->published_at->format('Y-m-d\TH:i') : '') }}"
            required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('published_at') border-red-500 @enderror">
            @error('published_at')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Cover Field -->
        <div>
            <label for="cover" class="block text-sm font-medium text-gray-700">Cover</label>
            <img class="img-preview w-full h-auto mb-3 sm:w-5/12">
            <input accept="image/*" type="file" name="cover" id="cover" onchange="previewImage()"
            class="p-2 mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white focus:outline-none focus:border-indigo-500 focus:ring-indigo-500 @error('cover') border-red-500 @enderror">
            <p id="cover-filename" class="mt-1 text-sm text-gray-500"></p>
            @error('cover')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Category Select Field -->
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category_id" id="category_id" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('category_id') border-red-500 @enderror">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id' ?? '') == $category->id)>
                    {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- author Select Field -->
        <div>
            <label for="author_id" class="block text-sm font-medium text-gray-700">Author</label>
            <select name="author_id" id="author_id" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('author_id') border-red-500 @enderror">
                <option value=""></option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" @selected(old('author_id' ?? '') == $author->id)>
                    {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
  
        <!-- Submit Button -->
        <div>
          <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Create
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
<script>
    function previewImage(params) {
      const image = document.querySelector('#cover');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
</script>
  

@endsection