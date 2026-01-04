<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    use WithPagination;

    // --- PROPERTI FORM ---
    public $name, $email, $password, $nip, $role = 'staff';
    public $jabatan, $no_hp, $pangkat;
    public $user_id;

    // --- PROPERTI UI & MODAL ---
    public $showForm = false;
    public $isEditMode = false;
    public $viewMode = 'list'; // Pilihan: 'list' (Kelola), 'stats' (Kinerja), 'logs' (Keamanan)
    public $search = '';

    // Menjaga agar filter tetap ada saat halaman di-refresh
    protected $queryString = [
        'viewMode' => ['except' => 'list'],
        'search' => ['except' => ''],
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        $users = collect();
        $logs = collect();

        // 1. Logika untuk Tampilan Kelola Personil & Statistik Kinerja
        if ($this->viewMode === 'list' || $this->viewMode === 'stats') {
            $query = User::withCount([
                'lapinhars',
                'dpos',
                'wnas',
                'ormas',
                'pamSdos',
                'jmsActivities',
                'kerawanans',
                'lapdus'
            ]);

            // Filter Pencarian (Nama atau NIP)
            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('nip', 'like', '%' . $this->search . '%');
                });
            }

            // Jika mode Statistik, biasanya fokus ke kinerja Staff (Admin disembunyikan)
            if ($this->viewMode === 'stats') {
                $query->where('role', '!=', 'admin');
            }

            $users = $query->orderBy('role', 'asc')
                ->orderBy('name', 'asc')
                ->paginate(10, ['*'], 'usersPage');
        }

        // 2. Logika untuk Tampilan Log Aktivitas (Keamanan)
        if ($this->viewMode === 'logs') {
            $logQuery = ActivityLog::with('user');

            if ($this->search) {
                $logQuery->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhere('activity', 'like', '%' . $this->search . '%')
                    ->orWhere('ip_address', 'like', '%' . $this->search . '%');
            }

            $logs = $logQuery->latest()->paginate(15, ['*'], 'logsPage');
        }

        return view('livewire.users.user-index', [
            'users' => $users,
            'logs'  => $logs
        ]);
    }

    // --- NAVIGATION SWITCHER ---
    public function setView($mode)
    {
        $this->viewMode = $mode;
        $this->showForm = false;
        $this->search = ''; // Reset pencarian saat pindah tab
        $this->resetPage('usersPage');
        $this->resetPage('logsPage');
    }

    // --- CRUD ACTIONS ---
    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required',
            'nip'      => 'nullable|numeric|unique:users,nip',
        ]);

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'nip'      => $this->nip,
            'role'     => $this->role,
            'jabatan'  => $this->jabatan,
            'no_hp'    => $this->no_hp,
            'pangkat'  => $this->pangkat,
        ]);

        session()->flash('message', 'Personil berhasil didaftarkan ke sistem.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->user_id = $id;
        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->nip     = $user->nip;
        $this->role    = $user->role;
        $this->jabatan = $user->jabatan;
        $this->no_hp   = $user->no_hp;
        $this->pangkat = $user->pangkat;

        $this->showForm   = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role'  => 'required',
            'nip'   => 'nullable|numeric|unique:users,nip,' . $this->user_id,
        ]);

        $user = User::find($this->user_id);

        $data = [
            'name'    => $this->name,
            'email'   => $this->email,
            'nip'     => $this->nip,
            'role'    => $this->role,
            'jabatan' => $this->jabatan,
            'no_hp'   => $this->no_hp,
            'pangkat' => $this->pangkat,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data personil berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        if ($id == auth()->id()) {
            session()->flash('error', 'Keamanan: Anda tidak diperbolehkan menghapus akun sendiri.');
            return;
        }

        User::find($id)->delete();
        session()->flash('message', 'Akun personil telah dihapus dari sistem.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'nip', 'role', 'jabatan', 'no_hp', 'pangkat', 'user_id']);
        $this->role = 'staff';
    }
}
