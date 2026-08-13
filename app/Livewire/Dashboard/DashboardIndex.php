<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Layout;

class DashboardIndex extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
