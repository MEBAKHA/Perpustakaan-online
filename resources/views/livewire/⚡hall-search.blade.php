<?php

use Livewire\Component;
use App\Models\Book;
use App\Models\User;

new class extends Component
{
    public $search = '';

    public function getSuggestionsProperty()
    {
        $books = Book::where('name', 'like', '%' . $this->search . '%')
            ->limit(5)
            ->get()
            ->map(function ($book) {
                return [
                    'type' => 'book',
                    'name' => $book->name,
                    'url' => '/hall/book/' . $book->slug,
                ];
            });

        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->limit(5)
            ->get()
            ->map(function ($user) {
                return [
                    'type' => 'user',
                    'name' => $user->name,
                    'username' => $user->username,
                    'url' => '/profile/' . $user->username,
                ];
            });
        $people = User::where('name', 'like', '%' . $this->search . '%')  
            ->orWhere('username', 'like', '%' . $this->search . '%')
            ->limit(5)
            ->get()
            ->map(function ($user) {
                return [
                    
                    'type' => 'user',
                    'name' => $user->name,
                    'username' => $user->username,
                    'url' => '/people/' . $user->username,
                ];

            });  

       return collect($books)->merge($users)->merge($people)->unique('url');
    }
};
?>

<div class="max-w-3xl mx-auto mb-6 relative">

    <div class="flex items-center bg-white shadow-md rounded-lg overflow-visible">

        <div class="relative w-full">

            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Cari story / user..."
                class="w-full px-4 py-2 text-gray-700 focus:outline-none"
            >

            @if(strlen($search) > 0)

                <div class="absolute top-full left-0 w-full bg-white shadow-md rounded-b-lg z-50 border overflow-hidden">

                   @forelse($this->suggestions as $item)

                        <a
                            wire:navigate
                            href="{{ $item['url'] }}"
                            class="block px-4 py-3 hover:bg-gray-100 transition"
                        >

                            @if($item['type'] === 'book')

                                <div class="font-semibold text-gray-800">
                                    📚 {{ $item['name'] }}
                                </div>

                            @else

                                <div class="font-semibold text-gray-800">
                                    👤 {{ $item['name'] }}
                                </div>

                                <div class="text-sm text-gray-500">
                                    {{ '@' . $item['username'] }}
                                </div>

                            @endif

                        </a>

                    @empty

                        <div class="px-4 py-3 text-gray-500">
                            Tidak ada hasil pencarian...
                        </div>

                    @endforelse

                </div>

            @endif

        </div>

        <a  
            href="/hall?search={{ $search }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-all"
        >
            <i class="fa-solid fa-search"></i>
        </a>

    </div>

</div>