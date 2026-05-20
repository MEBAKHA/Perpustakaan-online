<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;

class HallSearch extends Component
{
    public $search = '';

    public function render()
    {
        $suggestions = Book::where('name', 'like', '%' . $this->search . '%')
            ->limit(5)
            ->pluck('name');

        return view('livewire.hall-search', [
            'suggestions' => $suggestions
        ]);
    }
}