<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout; // 1. Import class Layout
use App\Models\User;

class UserIndex extends Component
{
    use WithPagination;

    public $search = '';

    // Reset pagination saat melakukan pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // 2. Tambahkan Attribute ini agar error MissingLayoutException hilang
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.user-index', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10),
        ]);
    }
}
