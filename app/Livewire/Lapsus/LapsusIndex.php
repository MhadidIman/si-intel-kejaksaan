<?php

namespace App\Livewire\Lapsus;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Lapsus;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LapsusIndex extends Component
{
    use WithPagination;

    // Pencarian
    public $search = '';

    // Properti Form
    public $lapsusId;
    public $tanggal_laporan;
    public $tingkat_kerahasiaan = 'Penting';
    public $siapa;
    public $apa;
    public $kapan;
    public $dimana;
    public $mengapa;
    public $bagaimana;
    public $analisa;
    public $saran;

    // Properti Status Modal
    public $isOpen = false;
    public $isDeleteOpen = false;
    public $isStatusModalOpen = false;
    public $statusLaporanId;

    protected $rules = [
        'tanggal_laporan' => 'required|date',
        'tingkat_kerahasiaan' => 'required|in:Penting,Rahasia,Sangat Rahasia',
        'siapa' => 'required|string',
        'apa' => 'required|string',
        'kapan' => 'required|string',
        'dimana' => 'required|string',
        'mengapa' => 'required|string',
        'bagaimana' => 'required|string',
        'analisa' => 'nullable|string',
        'saran' => 'nullable|string',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Lapsus::with('user')
            ->where('apa', 'like', '%' . $this->search . '%')
            ->orWhere('dimana', 'like', '%' . $this->search . '%')
            ->orWhere('siapa', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.lapsus.lapsus-index', ['lapsus' => $data]);
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        Lapsus::updateOrCreate(['id' => $this->lapsusId], [
            'user_id' => Auth::id(),
            'tanggal_laporan' => $this->tanggal_laporan,
            'tingkat_kerahasiaan' => $this->tingkat_kerahasiaan,
            'siapa' => $this->siapa,
            'apa' => $this->apa,
            'kapan' => $this->kapan,
            'dimana' => $this->dimana,
            'mengapa' => $this->mengapa,
            'bagaimana' => $this->bagaimana,
            'analisa' => $this->analisa,
            'saran' => $this->saran,
            // Jika data baru, set status pending. Jika edit, pertahankan status lama.
            'status' => $this->lapsusId ? Lapsus::find($this->lapsusId)->status : 'pending',
        ]);

        session()->flash('message', $this->lapsusId ? 'Laporan berhasil diperbarui.' : 'Laporan baru berhasil ditambahkan.');
        $this->isOpen = false;
        $this->resetFields();
    }

    public function edit($id)
    {
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Akses Ditolak: Hanya Admin yang memiliki otoritas untuk mengubah data.');
            return;
        }

        $laporan = Lapsus::findOrFail($id);
        $this->lapsusId = $id;
        $this->tanggal_laporan = Carbon::parse($laporan->tanggal_laporan)->format('Y-m-d');
        $this->tingkat_kerahasiaan = $laporan->tingkat_kerahasiaan;
        $this->siapa = $laporan->siapa;
        $this->apa = $laporan->apa;
        $this->kapan = $laporan->kapan;
        $this->dimana = $laporan->dimana;
        $this->mengapa = $laporan->mengapa;
        $this->bagaimana = $laporan->bagaimana;
        $this->analisa = $laporan->analisa;
        $this->saran = $laporan->saran;

        $this->isOpen = true;
    }

    public function confirmDelete($id)
    {
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Akses Ditolak: Hanya Admin yang memiliki otoritas untuk menghapus data.');
            return;
        }

        $this->lapsusId = $id;
        $this->isDeleteOpen = true;
    }

    public function delete()
    {
        Lapsus::find($this->lapsusId)->delete();
        session()->flash('message', 'Laporan berhasil dihapus.');
        $this->isDeleteOpen = false;
        $this->resetFields();
    }

    // --- FUNGSI VERIFIKASI STATUS ---
    public function openStatusModal($id)
    {
        $this->statusLaporanId = $id;
        $this->isStatusModalOpen = true;
    }

    public function closeStatusModal()
    {
        $this->isStatusModalOpen = false;
        $this->statusLaporanId = null;
    }

    public function updateStatus($status)
    {
        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Akses Ditolak: Hanya Admin yang dapat memverifikasi.');
            return;
        }

        $laporan = Lapsus::find($this->statusLaporanId);
        if ($laporan) {
            $laporan->status = $status;
            $laporan->save();
            session()->flash('message', 'Status laporan berhasil diperbarui.');
        }

        $this->closeStatusModal();
    }

    public function resetFields()
    {
        $this->reset([
            'lapsusId',
            'tanggal_laporan',
            'siapa',
            'apa',
            'kapan',
            'dimana',
            'mengapa',
            'bagaimana',
            'analisa',
            'saran',
            'statusLaporanId'
        ]);
        $this->tingkat_kerahasiaan = 'Penting';
    }
}
