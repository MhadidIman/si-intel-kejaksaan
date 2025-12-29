<?php

namespace App\Livewire\Kerawanan;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\Kerawanan;
use Illuminate\Support\Facades\Auth;

class KerawananIndex extends Component
{
    use WithPagination;

    // Form Variables
    public $kecamatan, $bidang, $potensi_ancaman, $sumber_informasi, $tingkat_rawan = 'rendah', $upaya_pencegahan;
    public $status_verifikasi = 'pending';
    public $kerawanan_id;

    // UI Variables
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';

    // Modal Status
    public $showStatusModal = false;
    public $targetId = null;

    protected $rules = [
        'kecamatan' => 'required',
        'bidang' => 'required',
        'potensi_ancaman' => 'required',
        'tingkat_rawan' => 'required|in:tinggi,sedang,rendah',
    ];

    // --- FITUR OTOMATISASI UPAYA PENCEGAHAN ---
    // Fungsi ini akan jalan otomatis saat Anda merubah pilihan dropdown "Tingkat Kerawanan"
    public function updatedTingkatRawan($value)
    {
        // Jika sedang mode edit dan text area sudah ada isinya, kita tanya dulu atau biarkan (opsional).
        // Disini kita buat otomatis menimpa untuk kemudahan.

        switch ($value) {
            case 'tinggi':
                $this->upaya_pencegahan = "Melakukan penggalangan terhadap tokoh kunci, koordinasi intensif dengan aparat keamanan (TNI/Polri), dan pelaksanaan operasi intelijen pengamanan tertutup (Pam-Tup).";
                break;

            case 'sedang':
                $this->upaya_pencegahan = "Meningkatkan frekuensi pemantauan lapangan, koordinasi dengan perangkat desa/kecamatan, dan melakukan deteksi dini terhadap potensi gejolak.";
                break;

            case 'rendah':
                $this->upaya_pencegahan = "Melakukan monitoring berkala, penyuluhan hukum (JMS/Penyuluhan) kepada masyarakat, dan menjaga komunikasi dengan informan di lapangan.";
                break;

            default:
                $this->upaya_pencegahan = "";
        }
    }
    // -------------------------------------------

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
        if (Auth::user()->isAdmin() && $this->targetId) {
            Kerawanan::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status pemetaan berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.kerawanan.kerawanan-index', [
            'peta' => Kerawanan::where('kecamatan', 'like', '%' . $this->search . '%')
                ->orWhere('potensi_ancaman', 'like', '%' . $this->search . '%')
                ->orderByRaw("FIELD(tingkat_rawan, 'tinggi', 'sedang', 'rendah')")
                ->paginate(10)
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showForm = true;
        $this->isEditMode = false;

        // Trigger default untuk 'rendah' saat buka form baru
        $this->updatedTingkatRawan('rendah');
    }

    public function store()
    {
        $this->validate();

        Kerawanan::create([
            'user_id' => Auth::id(), // <--- TAMBAHKAN INI
            'kecamatan' => $this->kecamatan,
            'bidang' => $this->bidang,
            'potensi_ancaman' => $this->potensi_ancaman,
            'sumber_informasi' => $this->sumber_informasi,
            'tingkat_rawan' => $this->tingkat_rawan,
            'upaya_pencegahan' => $this->upaya_pencegahan,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data Kerawanan berhasil dipetakan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Kerawanan::findOrFail($id);

        if ($data->status_verifikasi === 'disetujui' && !Auth::user()->isAdmin()) {
            session()->flash('message', 'Data yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->kerawanan_id = $id;
        $this->kecamatan = $data->kecamatan;
        $this->bidang = $data->bidang;
        $this->potensi_ancaman = $data->potensi_ancaman;
        $this->sumber_informasi = $data->sumber_informasi;
        $this->tingkat_rawan = $data->tingkat_rawan;
        $this->upaya_pencegahan = $data->upaya_pencegahan;
        $this->status_verifikasi = $data->status_verifikasi;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $data = Kerawanan::findOrFail($this->kerawanan_id);

        $data->update([
            'kecamatan' => $this->kecamatan,
            'bidang' => $this->bidang,
            'potensi_ancaman' => $this->potensi_ancaman,
            'sumber_informasi' => $this->sumber_informasi,
            'tingkat_rawan' => $this->tingkat_rawan,
            'upaya_pencegahan' => $this->upaya_pencegahan,
            'status_verifikasi' => Auth::user()->isAdmin() ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data Kerawanan diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        Kerawanan::findOrFail($id)->delete();
        session()->flash('message', 'Data dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->kecamatan = '';
        $this->bidang = '';
        $this->potensi_ancaman = '';
        $this->sumber_informasi = '';
        $this->tingkat_rawan = 'rendah';
        $this->upaya_pencegahan = '';
        $this->status_verifikasi = 'pending';
    }
}
