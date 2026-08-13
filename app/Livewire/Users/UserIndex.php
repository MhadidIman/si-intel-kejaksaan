<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads; // Tambahkan ini untuk upload foto
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination, WithFileUploads;

    // --- PROPERTI FORM ---
    public $name, $email, $password, $nip, $role = 'staff';
    public $jabatan, $no_hp, $pangkat, $satuan_kerja = 'Kejari Banjarmasin';
    public $foto_profile, $foto_lama;
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
                'kerawanans'
            ]);

            // FILTER UTAMA: JANGAN TAMPILKAN AKUN MASYARAKAT DI HALAMAN MANAJEMEN PERSONIL
            $query->where('role', '!=', 'masyarakat');

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
            $logQuery = ActivityLog::whereHas('user', function ($q) {
                $q->where('role', '!=', 'masyarakat');
            })->with('user');

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
            'nip'      => 'nullable|string|unique:users,nip',
            'foto_profile' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($this->foto_profile) {
            $path = $this->foto_profile->store('profile-photos', 'public');
        }

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'nip'      => $this->nip,
            'role'     => $this->role,
            'jabatan'  => $this->jabatan,
            'no_hp'    => $this->no_hp,
            'pangkat'  => $this->pangkat,
            'satuan_kerja' => $this->satuan_kerja,
            'foto_profile' => $path,
        ]);

        session()->flash('message', 'Personil berhasil didaftarkan ke sistem.');
        $this->closeModal();
    }

    public function edit($id)
    {
        // PERBAIKAN 1: Bersihkan input file agar tidak bentrok dengan sisa upload sebelumnya
        $this->reset('foto_profile');

        $user = User::findOrFail($id);

        $this->user_id = $id;
        $this->name    = $user->name;
        $this->email   = $user->email;
        $this->nip     = $user->nip;
        $this->role    = $user->role;
        $this->jabatan = $user->jabatan;
        $this->no_hp   = $user->no_hp;
        $this->pangkat = $user->pangkat;
        $this->satuan_kerja = $user->satuan_kerja;
        $this->foto_lama = $user->foto_profile;

        $this->showForm   = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'role'  => 'required',
            'nip'   => 'nullable|string|unique:users,nip,' . $this->user_id,
            'foto_profile' => 'nullable|image|max:2048',
            // PERBAIKAN 2: Pastikan validasi jalan saat mau mengganti password
            'password' => 'nullable|min:6',
        ]);

        $user = User::findOrFail($this->user_id);

        $path = $user->foto_profile;
        if ($this->foto_profile) {
            // Hapus foto lama jika ada
            if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
                Storage::disk('public')->delete($user->foto_profile);
            }
            $path = $this->foto_profile->store('profile-photos', 'public');
        }

        $data = [
            'name'    => $this->name,
            'email'   => $this->email,
            'nip'     => $this->nip,
            'role'    => $this->role,
            'jabatan' => $this->jabatan,
            'no_hp'   => $this->no_hp,
            'pangkat' => $this->pangkat,
            'satuan_kerja' => $this->satuan_kerja,
            'foto_profile' => $path,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $user->update($data);

        session()->flash('message', 'Data personil berhasil diperbarui.');
        $this->closeModal();
    }

    
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteOpen = true;
    }

    public function delete()
    {
        $id = $this->deleteId;
        if ($id == auth()->id()) {
            session()->flash('error', 'Keamanan: Anda tidak diperbolehkan menghapus akun sendiri.');
            return;
        }

        $user = User::findOrFail($id);

        // Hapus foto profile dari storage lokal sebelum user dihapus
        if ($user->foto_profile && Storage::disk('public')->exists($user->foto_profile)) {
            Storage::disk('public')->delete($user->foto_profile);
        }

        $user->delete();
        session()->flash('message', 'Akun personil telah dihapus dari sistem.');
        $this->isDeleteOpen = false;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->reset(['name', 'email', 'password', 'nip', 'role', 'jabatan', 'no_hp', 'pangkat', 'satuan_kerja', 'foto_profile', 'foto_lama', 'user_id']);
        $this->role = 'staff';
        $this->satuan_kerja = 'Kejari Banjarmasin';
    }
}
