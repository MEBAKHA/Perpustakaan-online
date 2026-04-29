<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="h-full">

  <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm ">
        <img class="mx-auto h-10 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register your account</h2>
      </div>
    
      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/registration" method="POST">
          @csrf
		      <div>
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" autocomplete="name" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 sm:text-sm/6 {{ $errors->has('name') ? 'outline-red-300 focus:outline-red-600' : 'outline-gray-300 focus:outline-indigo-600' }}" value="{{ old('name') }}">
              @error('name')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>   
              @enderror
            </div>
          </div>
		      <div>
            <label for="slug" class="block text-sm/6 font-medium text-gray-900">slug</label>
            <div class="mt-2">
              <input type="text" name="slug" id="slug" autocomplete="slug" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 sm:text-sm/6 {{ $errors->has('slug') ? 'outline-red-300 focus:outline-red-600' : 'outline-gray-300 focus:outline-indigo-600' }}" value="{{ old('slug') }}">
              @error('slug')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>   
              @enderror
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
              <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('email') ? 'outline-red-300 focus:outline-red-600' : 'outline-gray-300 focus:outline-indigo-600' }}" value="{{ old('email') }}">
              @error('email')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>   
              @enderror
            </div>
          </div>

          <div>
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2">
              <input type="text" name="username" id="username" autocomplete="username" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('username') ? 'outline-red-300 focus:outline-red-600' : 'outline-gray-300 focus:outline-indigo-600' }}" value="{{ old('username') }}">
              @error('username')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>   
              @enderror
            </div>
          </div>
    
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
              <div class="text-sm">
                {{-- <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a> --}}
              </div>
            </div>
            <div class="mt-2">
              <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 {{ $errors->has('password') ? 'outline-red-300 focus:outline-red-600' : 'outline-gray-300 focus:outline-indigo-600' }}" value="{{ old('password') }}">
              @error('password')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <input type="hidden" name="role" value="user">
    
          <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Regist</button>
          </div>
        </form>
    
        <p class="mt-10 text-center text-sm/6 text-gray-500">
          Already have an account?
          <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Login here</a>
        </p>
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
  
</body>
</html>