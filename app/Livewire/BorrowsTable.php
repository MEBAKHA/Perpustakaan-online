<?php

namespace App\Http\Livewire;

use App\Models\Borrow;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BorrowsTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $borrows = Borrow::where('user_id', $this->user->id)
            ->latest()
            ->paginate(10);

        return view('livewire.borrows-table', compact('borrows'));
    }
}
