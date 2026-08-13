<?php

$modules = [
    ['dir' => 'Dpo', 'php' => 'DpoIndex.php', 'blade' => 'dpo-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Jms', 'php' => 'JmsIndex.php', 'blade' => 'jms-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Kerawanan', 'php' => 'KerawananIndex.php', 'blade' => 'kerawanan-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Lapdu', 'php' => 'LapduIndex.php', 'blade' => 'lapdu-index.blade.php', 'method' => 'eliminasiLapdu'],
    ['dir' => 'Lapinhar', 'php' => 'LapinharIndex.php', 'blade' => 'lapinhar-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Ormas', 'php' => 'OrmasIndex.php', 'blade' => 'ormas-index.blade.php', 'method' => 'delete'],
    ['dir' => 'PamSdo', 'php' => 'PamSdoIndex.php', 'blade' => 'pam-sdo-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Users', 'php' => 'UserIndex.php', 'blade' => 'user-index.blade.php', 'method' => 'delete'],
    ['dir' => 'Wna', 'php' => 'WnaIndex.php', 'blade' => 'wna-index.blade.php', 'method' => 'delete'],
];

$basePath = 'c:/laragon/www/si-intel-kejaksaan';

$modalHtml = <<<HTML

        {{-- ============================================================== --}}
        {{-- MODAL HAPUS DATA                                               --}}
        {{-- ============================================================== --}}
        @if(\$isDeleteOpen)
        <div class="fixed inset-0 z-[110] flex items-center justify-center bg-slate-900/80 backdrop-blur-sm p-4 transition-opacity">
            <div class="bg-white w-full max-w-sm rounded-[2rem] shadow-2xl p-8 relative animate-fade-in-up border border-slate-100 text-center">

                <div class="w-20 h-20 bg-red-50 text-red-500 border-4 border-red-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                    <i class="fas fa-exclamation-triangle text-3xl animate-pulse"></i>
                </div>

                <h3 class="text-xl font-black text-slate-800 uppercase tracking-widest mb-2">Hapus Data?</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-8">Data ini akan dihapus secara permanen dan tidak dapat dikembalikan. Lanjutkan?</p>

                <div class="flex flex-col gap-3">
                    <button wire:click="DELETE_METHOD_NAME" class="w-full py-3.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-black uppercase text-xs tracking-widest transition-all shadow-lg shadow-red-500/30 flex items-center justify-center gap-2">
                        <i class="fas fa-trash-alt"></i> Ya, Hapus Permanen
                    </button>
                    <button wire:click="\$set('isDeleteOpen', false)" class="w-full py-3.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold uppercase text-xs tracking-widest transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
HTML;

foreach ($modules as $mod) {
    // 1. UPDATE BLADE FILE
    $bladePath = "$basePath/resources/views/livewire/" . strtolower($mod['dir']) . "/" . $mod['blade'];
    if (file_exists($bladePath)) {
        $bContent = file_get_contents($bladePath);
        
        // Remove SweetAlert
        $bContent = preg_replace('/x-on:click\.prevent="Swal\.fire[^\"]+"/', 'wire:click="confirmDelete({{ $item->id ?? $user->id ?? $selectedLapdu->id ?? $dpo->id }})"', $bContent);
        // Specifically for user-index which uses $user->id, lapdu which uses $selectedLapdu->id, etc.
        // A better regex for the id extraction:
        $bContent = preg_replace_callback('/x-on:click\.prevent="Swal\.fire\(.*\$wire\.[a-zA-Z]+\(\{\{\s*(\$[a-zA-Z0-9_>]+)\s*\}\}\).*"/', function($m) {
            return 'wire:click="confirmDelete({{ ' . $m[1] . ' }})"';
        }, $bContent);

        // Append modal if not exists
        if (strpos($bContent, 'MODAL HAPUS DATA') === false) {
            // Replace the closing tags with the modal
            $bContent = preg_replace('/(\s*<\/div>\s*<\/div>\s*)$/', str_replace('DELETE_METHOD_NAME', $mod['method'], $modalHtml), $bContent);
        }
        
        file_put_contents($bladePath, $bContent);
        echo "Updated Blade: {$mod['blade']}\n";
    }

    // 2. UPDATE PHP FILE
    $phpPath = "$basePath/app/Livewire/" . $mod['dir'] . "/" . $mod['php'];
    if (file_exists($phpPath)) {
        $pContent = file_get_contents($phpPath);
        
        // Add variables if not exist
        if (strpos($pContent, 'public $isDeleteOpen = false;') === false) {
            $pContent = preg_replace('/(class [a-zA-Z]+ extends Component\s*\{\s*use [a-zA-Z, ]+;|\nclass [a-zA-Z]+ extends Component\s*\{)/', "$1\n\n    public \$isDeleteOpen = false;\n    public \$deleteId = null;\n", $pContent);
        }

        // Add confirmDelete method if not exist
        if (strpos($pContent, 'public function confirmDelete(') === false) {
            $confirmMethod = <<<PHP

    public function confirmDelete(\$id)
    {
        \$this->deleteId = \$id;
        \$this->isDeleteOpen = true;
    }
PHP;
            // Insert it before the actual delete method
            $pContent = preg_replace('/(public function ' . $mod['method'] . '\(\$id\))/', $confirmMethod . "\n\n    $1", $pContent);
        }

        // Update the delete method signature and inject id retrieval
        if (preg_match('/public function ' . $mod['method'] . '\(\$id\)\s*\{/', $pContent)) {
            $pContent = preg_replace('/public function ' . $mod['method'] . '\(\$id\)\s*\{/', "public function {$mod['method']}()\n    {\n        \$id = \$this->deleteId;", $pContent);
            
            // At the end of the method body, close the modal.
            // This is tricky with regex. Let's just find `session()->flash('message'` inside delete and append.
            // Or better, just inject it before `}` of the method.
            // I'll do a simple string replace for the success message.
        }

        // Append closing state to the end of the success messages in delete/eliminasiLapdu
        $pContent = str_replace("session()->flash('message', 'Data dihapus.');", "session()->flash('message', 'Data dihapus.');\n        \$this->isDeleteOpen = false;", $pContent);
        $pContent = preg_replace("/(session\(\)->flash\('message',\s*'[^']*(hapus|eliminasi)[^']*'\);)/i", "$1\n        \$this->isDeleteOpen = false;", $pContent);


        file_put_contents($phpPath, $pContent);
        echo "Updated PHP: {$mod['php']}\n";
    }
}
