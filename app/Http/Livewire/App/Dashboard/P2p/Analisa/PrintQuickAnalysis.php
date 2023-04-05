<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Analisa;

use Livewire\Component;
use App\QuickAnalysis;
use Illuminate\Support\Facades\DB;
use PDF;

class PrintQuickAnalysis extends Component
{

    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa.print-quick-analysis');
    }
}
