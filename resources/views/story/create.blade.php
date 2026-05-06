@extends('layouts.main')

@section('konten')
<div class="min-h-screen bg-gray-100 py-10 px-4">

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            📚 Create New Book
        </h2>

        <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

        <div class="grid md:grid-cols-3 gap-6">

            <!-- COVER -->
            <div>
                <div class="border-2 border-dashed rounded-xl h-64 flex items-center justify-center cursor-pointer hover:bg-gray-50 relative overflow-hidden">

                    <img id="previewImage" class="hidden w-full h-full object-cover absolute inset-0">

                    <label class="flex flex-col items-center cursor-pointer z-10">
                        <i class="fa-solid fa-image text-4xl text-gray-400 mb-2"></i>
                        <span class="text-gray-500 text-sm">Upload Cover</span>
                        <input type="file" name="cover" class="hidden" onchange="previewCover(event)">
                    </label>

                    @error('cover')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>
            </div>

            <!-- FORM -->
            <div class="md:col-span-2 space-y-4">

                <!-- TITLE -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                            </div>

                <!-- SLUG -->
                <div>
        
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('slug') border-red-500 @enderror">
                    @error('slug')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    
                </div>

             <!-- CATEGORY -->
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


                <!-- DATE -->
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
        

            </div>
        </div>

        <!-- BODY -->
        <div>
            <label for="body" class="block text-sm font-medium text-gray-700">Body</label>
            <textarea name="body" id="body" rows="4" required
            class="mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('body') border-red-500 @enderror">{{ old('body', $book->body ?? '') }}</textarea>
            @error('body')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <br>
        
        <!-- Submit Button -->
        <div class="justify-center items-center">
          <button type="submit"
            class="inline-flex items-center px-12 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            Create
          </button>
        </div>        </form>    </form>
</div>

<script>
function previewCover(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const img = document.getElementById('previewImage');
        img.src = reader.result;
        img.classList.remove('hidden');
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

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