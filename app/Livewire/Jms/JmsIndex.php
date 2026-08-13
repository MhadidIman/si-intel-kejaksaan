<?php

namespace App\Livewire\Jms;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\JmsActivity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JmsIndex extends Component
{

    public $isDeleteOpen = false;
    public $deleteId = null;

    use WithPagination, WithFileUploads;

    // Form Variables
    public $nama_sekolah, $tanggal_kegiatan, $materi, $jumlah_siswa, $nama_jaksa, $keterangan;
    public $foto_kegiatan, $foto_lama;
    public $status_verifikasi = 'pending';
    public $jms_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Modal Status
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'nama_sekolah' => 'required',
        'tanggal_kegiatan' => 'required|date',
        'materi' => 'required',
        'jumlah_siswa' => 'required|integer',
        'foto_kegiatan' => 'nullable|image|max:5120', // Max 5MB
    ];

    // --- LOGIKA VERIFIKASI ---
    public function openStatusModal($id)
    {
        $this->targetId = $id;
        $this->showStatusModal = true;
    }

    public function closeStatusModal()
    {
        $this->showStatusModal = false;
        $this->targetId = null;
    }

    public function updateStatus($newStatus)
    {
        if (Auth::user()->role === 'admin' && $this->targetId) {
            JmsActivity::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status kegiatan berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }
    // -------------------------

    #[Layout('layouts.app')]
    public function render()
    {
        // TAMBAHKAN ::with('user') UNTUK MEMANGGIL NAMA PENGINPUT
        $activities = JmsActivity::with('user')
            ->where(function ($query) {
                $query->where('nama_sekolah', 'like', '%' . $this->search . '%')
                    ->orWhere('materi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('tanggal_kegiatan', 'desc')
            ->paginate(10);

        return view('livewire.jms.jms-index', [
            'activities' => $activities
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
        $this->validate();

        $path = null;
        if ($this->foto_kegiatan) {
            $path = $this->foto_kegiatan->store('jms-photos', 'public');
        }

        JmsActivity::create([
            'user_id' => Auth::id(), // <--- WAJIB: ID Penginput
            'nama_sekolah' => $this->nama_sekolah,
            'tanggal_kegiatan' => $this->tanggal_kegiatan,
            'materi' => $this->materi,
            'jumlah_siswa' => $this->jumlah_siswa,
            'nama_jaksa' => $this->nama_jaksa,
            'keterangan' => $this->keterangan,
            'foto_kegiatan' => $path,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Laporan JMS berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = JmsActivity::findOrFail($id);

        if ($data->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->jms_id = $id;
        $this->nama_sekolah = $data->nama_sekolah;
        $this->tanggal_kegiatan = $data->tanggal_kegiatan ? Carbon::parse($data->tanggal_kegiatan)->format('Y-m-d') : null;
        $this->materi = $data->materi;
        $this->jumlah_siswa = $data->jumlah_siswa;
        $this->nama_jaksa = $data->nama_jaksa;
        $this->keterangan = $data->keterangan;
        $this->foto_lama = $data->foto_kegiatan;
        $this->status_verifikasi = $data->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = JmsActivity::findOrFail($this->jms_id);

        $path = $data->foto_kegiatan;
        if ($this->foto_kegiatan) {
            if ($data->foto_kegiatan && Storage::disk('public')->exists($data->foto_kegiatan)) {
                Storage::disk('public')->delete($data->foto_kegiatan);
            }
            $path = $this->foto_kegiatan->store('jms-photos', 'public');
        }

        $data->update([
            'nama_sekolah' => $this->nama_sekolah,
            'tanggal_kegiatan' => $this->tanggal_kegiatan,
            'materi' => $this->materi,
            'jumlah_siswa' => $this->jumlah_siswa,
            'nama_jaksa' => $this->nama_jaksa,
            'keterangan' => $this->keterangan,
            'foto_kegiatan' => $path,
            'status_verifikasi' => Auth::user()->role === 'admin' ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data JMS diperbarui.');
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
        // KODE KEAMANAN: HANYA ADMIN YANG BISA MENGHAPUS
        if (Auth::user()->role !== 'admin') {
            session()->flash('message', 'Akses Ditolak! Hanya Admin yang berhak menghapus data.');
        $this->isDeleteOpen = false;
            return;
        }

        $data = JmsActivity::findOrFail($id);
        if ($data->foto_kegiatan && Storage::disk('public')->exists($data->foto_kegiatan)) {
            Storage::disk('public')->delete($data->foto_kegiatan);
        }
        $data->delete();
        session()->flash('message', 'Data dihapus.');
        $this->isDeleteOpen = false;
        $this->isDeleteOpen = false;
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama_sekolah = '';
        $this->tanggal_kegiatan = '';
        $this->materi = '';
        $this->jumlah_siswa = 0;
        $this->nama_jaksa = '';
        $this->keterangan = '';
        $this->foto_kegiatan = null;
        $this->foto_lama = null;
        $this->status_verifikasi = 'pending';
    }
}
