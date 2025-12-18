<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

class UserIndex extends Component
{
    use WithPagination;

    // DEFINISI VARIABEL PUBLIK (Wajib ada agar bisa dibaca di Blade)
    public $name, $email, $password, $user_id;

    // Variabel untuk mengontrol tampilan Form/Modal
    public $isEditMode = false;
    public $showForm = false;

    public $search = '';

    // Reset pagination saat searching
    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.users.user-index', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(8)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true; // Ini yang mentrigger tampilan form muncul
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'Personil berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = ''; // Kosongkan password saat edit

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
        ]);

        $user = User::find($this->user_id);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data personil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        // Cegah menghapus diri sendiri
        if ($id == auth()->id()) {
            return;
        }

        User::find($id)->delete();
        session()->flash('message', 'Personil dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = null;
    }
}
