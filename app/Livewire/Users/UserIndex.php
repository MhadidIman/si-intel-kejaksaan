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

    // --- PROPERTI FORM ---
    public $name, $email, $password, $nip, $role = 'staff';
    public $jabatan, $no_hp, $pangkat; // Menggunakan $pangkat agar konsisten

    public $user_id;

    // --- PROPERTI MODAL ---
    public $selectedUser = null;
    public $showStatsModal = false;
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'nip' => 'nullable',
        'role' => 'required',
        'jabatan' => 'nullable',
        'no_hp' => 'nullable',
        'pangkat' => 'nullable',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
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
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('nip', 'like', '%' . $this->search . '%');
            })
            ->orderBy('role', 'asc') // Admin selalu di atas
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.users.user-index', [
            'users' => $users
        ]);
    }

    // --- FITUR STATISTIK USER ---
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

    // --- CRUD ---
    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'nip' => $this->nip,
            'role' => $this->role,
            'jabatan' => $this->jabatan,
            'no_hp' => $this->no_hp,
            'pangkat' => $this->pangkat,
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
        $this->nip = $user->nip;
        $this->role = $user->role;
        $this->jabatan = $user->jabatan;
        $this->no_hp = $user->no_hp;
        $this->pangkat = $user->pangkat;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role' => 'required',
        ]);

        $user = User::find($this->user_id);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'nip' => $this->nip,
            'role' => $this->role,
            'jabatan' => $this->jabatan,
            'no_hp' => $this->no_hp,
            'pangkat' => $this->pangkat,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data Personil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Tidak dapat menghapus akun sendiri.');
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
        $this->nip = '';
        $this->role = 'staff';
        $this->jabatan = '';
        $this->no_hp = '';
        $this->pangkat = '';
        $this->user_id = null;
    }
}
