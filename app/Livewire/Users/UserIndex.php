<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    use WithPagination;

    // Properti Form
    public $name, $email, $nip, $role = 'staff', $password;
    public $user_id;

    // Properti Modal Statistik
    public $selectedUser = null;
    public $showStatsModal = false;

    // UI State
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'nip' => 'nullable|string',
        'role' => 'required',
        'password' => 'required|min:6',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        // Mengambil data user beserta jumlah laporan yang diinput (withCount)
        $users = User::withCount([
            'lapinhars',
            'dpos',
            'wnas',
            'ormas',
            'pamSdos',
            'jmsActivities',
            'kerawanans',
            'lapdus'
        ])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('nip', 'like', '%' . $this->search . '%')
            ->orderBy('role', 'asc') // Admin paling atas
            ->paginate(10);

        return view('livewire.users.user-index', [
            'users' => $users
        ]);
    }

    // --- LOGIC MODAL STATISTIK ---
    public function viewStats($id)
    {
        $this->selectedUser = User::withCount([
            'lapinhars',
            'dpos',
            'wnas',
            'ormas',
            'pamSdos',
            'jmsActivities',
            'kerawanans',
            'lapdus'
        ])->findOrFail($id);

        $this->showStatsModal = true;
    }

    public function closeStatsModal()
    {
        $this->showStatsModal = false;
        $this->selectedUser = null;
    }

    // --- LOGIC CRUD USER ---
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
            'email' => 'required|email|unique:users,email',
            'nip' => 'required|string|unique:users,nip', // Validasi Unik NIP
            'role' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'nip' => $this->nip,
            'role' => $this->role,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('message', 'User berhasil ditambahkan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nip = $user->nip;
        $this->role = $user->role;
        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            // Abaikan validasi unik untuk user ini sendiri saat update
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'nip' => 'required|string|unique:users,nip,' . $this->user_id,
            'role' => 'required',
        ]);

        $user = User::findOrFail($this->user_id);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'nip' => $this->nip,
            'role' => $this->role,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data User diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        // Mencegah hapus diri sendiri
        if ($id == auth()->id()) {
            session()->flash('error', 'Tidak dapat menghapus akun sendiri.');
            return;
        }

        User::find($id)->delete();
        session()->flash('message', 'User dihapus.');
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
        $this->nip = '';
        $this->role = 'staff';
        $this->password = '';
        $this->user_id = null;
    }
}
