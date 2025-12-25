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

    // DEFINISI VARIABEL PUBLIK
    // Menambahkan $nip dan $role agar data dapat ditangkap dari form dan disimpan ke database
    public $name, $email, $password, $user_id, $nip, $role;

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
                ->orWhere('nip', 'like', '%' . $this->search . '%') // Menambahkan pencarian berdasarkan NIP
                ->orderBy('created_at', 'desc')
                ->paginate(8)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|min:18|unique:users,nip', // Validasi NIP wajib diisi dan unik
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff', // Validasi role harus admin atau staff
        ]);

        User::create([
            'name' => $this->name,
            'nip' => $this->nip, // Menyimpan data NIP
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role, // Menyimpan data Role
        ]);

        session()->flash('message', 'Personil berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->nip = $user->nip; // Memuat data NIP saat edit
        $this->email = $user->email;
        $this->role = $user->role; // Memuat data Role saat edit
        $this->password = '';

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|min:18|unique:users,nip,' . $this->user_id,
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required|in:admin,staff',
        ]);

        $user = User::find($this->user_id);

        $data = [
            'name' => $this->name,
            'nip' => $this->nip, // Memperbarui data NIP
            'email' => $this->email,
            'role' => $this->role, // Memperbarui data Role
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data personil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
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
        $this->nip = ''; // Reset field NIP
        $this->email = '';
        $this->password = '';
        $this->role = ''; // Reset field Role
        $this->user_id = null;
    }
}
