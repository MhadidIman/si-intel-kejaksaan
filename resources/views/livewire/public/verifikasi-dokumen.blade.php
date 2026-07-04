<div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-6 border-t-4 border-green-500">

        <div class="flex justify-center mb-4">
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Dokumen Valid</h2>
        <p class="text-center text-gray-600 text-sm mb-6">
            Dokumen ini terdaftar secara resmi pada sistem Kejaksaan.
        </p>

        <div class="bg-gray-50 p-4 rounded-md space-y-3 text-sm">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500 font-medium">Jenis Dokumen:</span>
                <span class="text-gray-800 font-semibold uppercase">{{ $tipe }}</span>
            </div>

            @if($tipe === 'lapdu')
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500 font-medium">Nama Pelapor:</span>
                <span class="text-gray-800 font-semibold">{{ $dokumen->nama_pelapor ?? 'Hamba Allah' }}</span>
            </div>
            @elseif($tipe === 'lapinhar')
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500 font-medium">Nomor Surat:</span>
                <span class="text-gray-800 font-semibold">{{ $dokumen->nomor_surat ?? '-' }}</span>
            </div>
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500 font-medium">Bidang:</span>
                <span class="text-gray-800 text-right uppercase">{{ $dokumen->bidang ?? '-' }}</span>
            </div>
            @endif

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-500 font-medium">Tanggal Diterbitkan:</span>
                <span class="text-gray-800">{{ $dokumen->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="flex justify-between pt-1">
                <span class="text-gray-500 font-medium">Penandatangan:</span>
                <span class="text-gray-800 font-bold">Kasi Intelijen</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="text-blue-600 hover:underline text-sm font-medium">Kembali ke Beranda</a>
        </div>
    </div>
</div>