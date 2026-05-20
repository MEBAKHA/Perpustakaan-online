@extends('layouts.main')

@section('konten')
<div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-lg p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Edit Profile
        </h2>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- BANNER -->
            <div>
                <img 
                    src="{{ auth()->user()->banner ? asset('storage/' . auth()->user()->banner) : 'https://picsum.photos/1200/300' }}" 
                    class="w-full h-64 object-cover rounded-lg"
                >

                <label class="block text-sm font-medium text-gray-700 mt-2">
                    Ganti Banner
                </label>

                <input type="file" name="banner"
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:bg-blue-50 file:text-blue-700">

                @error('banner')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- AVATAR -->
            <div class="flex items-center gap-6">
                <img 
                    src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://upload.wikimedia.org/wikipedia/en/9/96/Meme_Man_on_transparent_background.webp' }}" 
                    class="w-20 h-20 rounded-full object-cover border"
                >

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Ganti Avatar
                    </label>

                    <input type="file" name="avatar"
                        class="block w-full text-sm rounded-3xl px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-blue-50 file:text-blue-700">

                    @error('avatar')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- USERNAME -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Username
                </label>

                <input type="text" name="username"
                    value="{{ old('username', auth()->user()->username) }}"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">

                @error('username')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- EMAIL -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Email
                </label>

                <input type="email" name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">

                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- BIO -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Bio
                </label>

                <textarea name="bio" rows="4"
                    class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500">{{ old('bio', auth()->user()->bio) }}</textarea>
            </div>

            <!-- SUBMIT -->
            <div class="flex justify-end">
                <button wire:click="updateProfile" class=" bg-blue-400 text-white py-3 px-2 rounded-2xl" onclick="return confirmUpdate()" type="submit">
                    Update Profile
                </button>

                <script>
                function confirmUpdate() {
                    return confirm('Yakin mau update profile?');
                }
                </script>
            </div>

        </form>
    </div>
</div>
@endsection