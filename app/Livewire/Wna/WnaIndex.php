<?php

namespace App\Livewire\Wna;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Wna;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WnaIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Properti Data
    public $nama_lengkap, $nomor_paspor, $kebangsaan, $tanggal_tiba, $masa_berlaku_izin_tinggal;
    public $tujuan_kunjungan, $sponsor, $alamat_menginap, $foto_dokumen, $foto_lama;
    public $wna_id;

    // UI & Search
    public $isEditMode = false;
    public $showForm = false;
    public $search = '';
    public $filterStatus = ''; // Filter baru: all, aman, warning, overstay

    protected $rules = [
        'nama_lengkap' => 'required',
        'nomor_paspor' => 'required',
        'kebangsaan' => 'required',
        'masa_berlaku_izin_tinggal' => 'required|date',
        'tujuan_kunjungan' => 'required',
        'alamat_menginap' => 'required',
        'foto_dokumen' => 'nullable|image|max:2048',
    ];

    #[Layout('layouts.app')]
    public function render()
    {
        $query = Wna::query();

        // 1. Logic Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_lengkap', 'like', '%' . $this->search . '%')
                    ->orWhere('nomor_paspor', 'like', '%' . $this->search . '%')
                    ->orWhere('kebangsaan', 'like', '%' . $this->search . '%');
            });
        }

        // 2. Logic Filter Status (Perbaikan Perhitungan)
        $today = Carbon::now()->startOfDay();
        $warningLimit = Carbon::now()->addDays(30)->endOfDay(); // H-30 Warning

        if ($this->filterStatus === 'overstay') {
            // Tanggal izin < Hari ini
            $query->whereDate('masa_berlaku_izin_tinggal', '<', $today);
        } elseif ($this->filterStatus === 'warning') {
            // Hari ini <= Tanggal Izin <= 30 Hari kedepan
            $query->whereDate('masa_berlaku_izin_tinggal', '>=', $today)
                ->whereDate('masa_berlaku_izin_tinggal', '<=', $warningLimit);
        } elseif ($this->filterStatus === 'aman') {
            // Tanggal Izin > 30 Hari kedepan
            $query->whereDate('masa_berlaku_izin_tinggal', '>', $warningLimit);
        }

        $wnas = $query->orderBy('masa_berlaku_izin_tinggal', 'asc')->paginate(10);

        return view('livewire.wna.wna-index', [
            'wnas' => $wnas,
            'countOverstay' => Wna::whereDate('masa_berlaku_izin_tinggal', '<', $today)->count(),
            'countWarning' => Wna::whereDate('masa_berlaku_izin_tinggal', '>=', $today)
                ->whereDate('masa_berlaku_izin_tinggal', '<=', $warningLimit)->count()
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
        if ($this->foto_dokumen) {
            $path = $this->foto_dokumen->store('wna-docs', 'public');
        }

        Wna::create([
            'user_id' => Auth::id(), // <--- TAMBAHKAN INI
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba ?: null,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path,
            'status_verifikasi' => 'pending',
        ]);

        session()->flash('message', 'Data WNA berhasil disimpan.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $wna = Wna::findOrFail($id);
        $this->wna_id = $id;
        $this->nama_lengkap = $wna->nama_lengkap;
        $this->nomor_paspor = $wna->nomor_paspor;
        $this->kebangsaan = $wna->kebangsaan;
        $this->tanggal_tiba = $wna->tanggal_tiba ? Carbon::parse($wna->tanggal_tiba)->format('Y-m-d') : null;
        $this->masa_berlaku_izin_tinggal = Carbon::parse($wna->masa_berlaku_izin_tinggal)->format('Y-m-d');
        $this->tujuan_kunjungan = $wna->tujuan_kunjungan;
        $this->sponsor = $wna->sponsor;
        $this->alamat_menginap = $wna->alamat_menginap;
        $this->foto_lama = $wna->foto_dokumen;

        $this->showForm = true;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();
        $wna = Wna::findOrFail($this->wna_id);

        $path = $wna->foto_dokumen;
        if ($this->foto_dokumen) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
            $path = $this->foto_dokumen->store('wna-photos', 'public');
        }

        $wna->update([
            'nama_lengkap' => $this->nama_lengkap,
            'nomor_paspor' => $this->nomor_paspor,
            'kebangsaan' => $this->kebangsaan,
            'tanggal_tiba' => $this->tanggal_tiba ?: null,
            'masa_berlaku_izin_tinggal' => $this->masa_berlaku_izin_tinggal,
            'tujuan_kunjungan' => $this->tujuan_kunjungan,
            'sponsor' => $this->sponsor,
            'alamat_menginap' => $this->alamat_menginap,
            'foto_dokumen' => $path,
        ]);

        session()->flash('message', 'Data WNA diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $wna = Wna::findOrFail($id);
        if ($wna->foto_dokumen && Storage::disk('public')->exists($wna->foto_dokumen)) {
            Storage::disk('public')->delete($wna->foto_dokumen);
        }
        $wna->delete();
        session()->flash('message', 'Data WNA dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->nama_lengkap = '';
        $this->nomor_paspor = '';
        $this->kebangsaan = '';
        $this->tanggal_tiba = '';
        $this->masa_berlaku_izin_tinggal = '';
        $this->tujuan_kunjungan = '';
        $this->sponsor = '';
        $this->alamat_menginap = '';
        $this->foto_dokumen = null;
        $this->foto_lama = null;
    }
}
