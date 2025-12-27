<?php

namespace App\Livewire\Lapinhar;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Lapinhar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LapinharIndex extends Component
{
    use WithPagination;

    // Properti Model Lapinhar
    public $nomor_surat, $tanggal_surat, $sumber_informasi, $bidang, $peristiwa, $pendapat, $status_keamanan = 'rahasia';
    public $status_verifikasi = 'pending';
    public $lapinhar_id;

    // State UI
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Aturan Validasi
    protected $rules = [
        'tanggal_surat' => 'required|date',
        'bidang' => 'required',
        'peristiwa' => 'required|min:5',
        'pendapat' => 'required|min:5',
    ];

    /**
     * Fitur: Setujui Laporan (Hanya Admin)
     */
    public function approve($id)
    {
        if (Auth::user()->isAdmin()) {
            $laporan = Lapinhar::findOrFail($id);
            $laporan->update(['status_verifikasi' => 'disetujui']);
            session()->flash('message', 'Laporan berhasil disetujui pimpinan.');
        }
    }

    /**
     * Fitur: Tolak Laporan (Hanya Admin)
     */
    public function reject($id)
    {
        if (Auth::user()->isAdmin()) {
            $laporan = Lapinhar::findOrFail($id);
            $laporan->update(['status_verifikasi' => 'ditolak']);
            session()->flash('message', 'Laporan telah ditolak/dikembalikan.');
        }
    }

    /**
     * Render Halaman
     */
    #[Layout('layouts.app')]
    public function render()
    {
        $lapinhars = Lapinhar::where(function ($query) {
            $query->where('peristiwa', 'like', '%' . $this->search . '%')
                ->orWhere('bidang', 'like', '%' . $this->search . '%')
                ->orWhere('nomor_surat', 'like', '%' . $this->search . '%');
        })
            ->orderBy('tanggal_surat', 'desc')
            ->paginate(10);

        return view('livewire.lapinhar.lapinhar-index', [
            'lapinhars' => $lapinhars
        ]);
    }

    /**
     * Buka Form Tambah
     */
    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;
    }

    /**
     * Simpan Data Baru
     */
    public function store()
    {
        $this->validate();

        Lapinhar::create([
            'user_id' => Auth::id(), // Mencatat user yang menginput
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status_keamanan' => $this->status_keamanan,
            'status_verifikasi' => 'pending', // Default
        ]);

        session()->flash('message', 'Laporan Lapinhar berhasil disimpan & menunggu verifikasi.');
        $this->closeModal();
    }

    /**
     * Buka Form Edit
     */
    public function edit($id)
    {
        $data = Lapinhar::findOrFail($id);

        // Proteksi: Staff tidak bisa edit data yang sudah disetujui
        if ($data->status_verifikasi === 'disetujui' && !Auth::user()->isAdmin()) {
            session()->flash('message', 'Akses ditolak: Laporan yang sudah disetujui tidak dapat diubah.');
            return;
        }

        $this->lapinhar_id = $id;
        $this->nomor_surat = $data->nomor_surat;

        // Memastikan format tanggal pas untuk input type="date"
        $this->tanggal_surat = $data->tanggal_surat instanceof \Carbon\Carbon
            ? $data->tanggal_surat->format('Y-m-d')
            : Carbon::parse($data->tanggal_surat)->format('Y-m-d');

        $this->sumber_informasi = $data->sumber_informasi;
        $this->bidang = $data->bidang;
        $this->peristiwa = $data->peristiwa;
        $this->pendapat = $data->pendapat;
        $this->status_keamanan = $data->status_keamanan;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    /**
     * Update Data
     */
    public function update()
    {
        $this->validate();

        $data = Lapinhar::findOrFail($this->lapinhar_id);

        $data->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'sumber_informasi' => $this->sumber_informasi,
            'bidang' => $this->bidang,
            'peristiwa' => $this->peristiwa,
            'pendapat' => $this->pendapat,
            'status_keamanan' => $this->status_keamanan,
            // Jika diedit oleh staf, status kembali ke pending
            'status_verifikasi' => Auth::user()->isAdmin() ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Laporan Lapinhar berhasil diperbarui.');
        $this->closeModal();
    }

    /**
     * Hapus Data
     */
    public function delete($id)
    {
        Lapinhar::findOrFail($id)->delete();
        session()->flash('message', 'Data Lapinhar telah dihapus dari sistem.');
    }

    /**
     * Tutup Modal/Form
     */
    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    /**
     * Reset Input
     */
    private function resetInputFields()
    {
        $this->nomor_surat = '';
        $this->tanggal_surat = '';
        $this->sumber_informasi = '';
        $this->bidang = '';
        $this->peristiwa = '';
        $this->pendapat = '';
        $this->status_keamanan = 'rahasia';
        $this->lapinhar_id = null;
    }
}
