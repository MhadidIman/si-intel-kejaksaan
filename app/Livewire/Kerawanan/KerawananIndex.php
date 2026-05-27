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

    // --- TAMBAHAN VARIABEL SPK & GIS ---
    public $latitude, $longitude;
    public $kriteria_dampak = 1;       // C1
    public $kriteria_probabilitas = 1; // C2
    public $kriteria_eskalasi = 1;     // C3
    // -----------------------------------

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
        'kriteria_dampak' => 'required|numeric|min:1|max:10',
        'kriteria_probabilitas' => 'required|numeric|min:1|max:10',
        'kriteria_eskalasi' => 'required|numeric|min:1|max:10',
    ];

    public function updatedTingkatRawan($value)
    {
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

    // --- LOGIKA PERHITUNGAN SPK (SAW) ---
    private function hitungSpkSAW()
    {
        // Penentuan Bobot (Bisa disesuaikan kebijakan Kejaksaan)
        $bobot_dampak = 0.40;       // 40%
        $bobot_probabilitas = 0.35; // 35%
        $bobot_eskalasi = 0.25;     // 25%

        // Normalisasi (Nilai Maksimal Kriteria adalah 10)
        $norm_dampak = $this->kriteria_dampak / 10;
        $norm_prob = $this->kriteria_probabilitas / 10;
        $norm_esk = $this->kriteria_eskalasi / 10;

        // Hitung Skor Akhir (Skala 0 - 1)
        $skor_akhir = ($norm_dampak * $bobot_dampak) + ($norm_prob * $bobot_probabilitas) + ($norm_esk * $bobot_eskalasi);

        // Ubah jadi persentase agar mudah dibaca (Skala 1 - 100)
        $skor_spk = $skor_akhir * 100;

        // Auto-Tentukan Tingkat Kerawanan berdasarkan Skor
        if ($skor_spk >= 75) {
            $this->tingkat_rawan = 'tinggi';
        } elseif ($skor_spk >= 40) {
            $this->tingkat_rawan = 'sedang';
        } else {
            $this->tingkat_rawan = 'rendah';
        }

        // Trigger text upaya pencegahan otomatis
        $this->updatedTingkatRawan($this->tingkat_rawan);

        return $skor_spk;
    }

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
            Kerawanan::where('id', $this->targetId)->update(['status_verifikasi' => $newStatus]);
            session()->flash('message', 'Status pemetaan berhasil diubah menjadi ' . strtoupper($newStatus));
            $this->closeStatusModal();
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        // Urutkan berdasarkan Skor SPK tertinggi (Prioritas Ancaman)
        $peta = Kerawanan::with('user')
            ->where(function ($query) {
                $query->where('kecamatan', 'like', '%' . $this->search . '%')
                    ->orWhere('potensi_ancaman', 'like', '%' . $this->search . '%');
            })
            ->orderBy('skor_spk', 'desc')
            ->paginate(10);

        return view('livewire.kerawanan.kerawanan-index', [
            'peta' => $peta
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

        // Eksekusi Perhitungan SPK
        $skor_spk = $this->hitungSpkSAW();

        Kerawanan::create([
            'user_id' => Auth::id(),
            'kecamatan' => $this->kecamatan,
            'bidang' => $this->bidang,
            'potensi_ancaman' => $this->potensi_ancaman,
            'sumber_informasi' => $this->sumber_informasi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'kriteria_dampak' => $this->kriteria_dampak,
            'kriteria_probabilitas' => $this->kriteria_probabilitas,
            'kriteria_eskalasi' => $this->kriteria_eskalasi,
            'skor_spk' => $skor_spk,
            'tingkat_rawan' => $this->tingkat_rawan,
            'upaya_pencegahan' => $this->upaya_pencegahan,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data Kerawanan dipetakan dengan Skor SPK: ' . number_format($skor_spk, 1));
        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Kerawanan::findOrFail($id);

        if ($data->status_verifikasi === 'disetujui' && Auth::user()->role !== 'admin') {
            session()->flash('message', 'Data yang sudah divalidasi tidak dapat diubah.');
            return;
        }

        $this->kerawanan_id = $id;
        $this->kecamatan = $data->kecamatan;
        $this->bidang = $data->bidang;
        $this->potensi_ancaman = $data->potensi_ancaman;
        $this->sumber_informasi = $data->sumber_informasi;

        $this->latitude = $data->latitude;
        $this->longitude = $data->longitude;
        $this->kriteria_dampak = $data->kriteria_dampak ?? 1;
        $this->kriteria_probabilitas = $data->kriteria_probabilitas ?? 1;
        $this->kriteria_eskalasi = $data->kriteria_eskalasi ?? 1;

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

        // Eksekusi Ulang Perhitungan SPK jika diedit
        $skor_spk = $this->hitungSpkSAW();

        $data->update([
            'kecamatan' => $this->kecamatan,
            'bidang' => $this->bidang,
            'potensi_ancaman' => $this->potensi_ancaman,
            'sumber_informasi' => $this->sumber_informasi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'kriteria_dampak' => $this->kriteria_dampak,
            'kriteria_probabilitas' => $this->kriteria_probabilitas,
            'kriteria_eskalasi' => $this->kriteria_eskalasi,
            'skor_spk' => $skor_spk,
            'tingkat_rawan' => $this->tingkat_rawan,
            'upaya_pencegahan' => $this->upaya_pencegahan,
            'status_verifikasi' => Auth::user()->role === 'admin' ? $data->status_verifikasi : 'pending',
        ]);

        session()->flash('message', 'Data Kerawanan diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        if (Auth::user()->role !== 'admin') {
            session()->flash('message', 'Akses Ditolak! Hanya Admin yang berhak menghapus data.');
            return;
        }

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
        $this->latitude = '';
        $this->longitude = '';
        $this->kriteria_dampak = 1;
        $this->kriteria_probabilitas = 1;
        $this->kriteria_eskalasi = 1;
        $this->tingkat_rawan = 'rendah';
        $this->upaya_pencegahan = '';
        $this->status_verifikasi = 'pending';
    }
}
