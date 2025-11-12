<?php

namespace App\Livewire;

use App\Models\crew;
use App\Models\rank;
use Livewire\Component;
use App\Models\UserLamaran;

class ScreeningTable extends Component
{
    public $month = ''; // default kosong

    public function render()
    {
        $ranks = rank::orderBy('name')->get();

        $query = UserLamaran::query();
        
        if (!empty($this->month)) {
            [$year, $month] = explode('-', $this->month);
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        }

        $data = $query->get();

        return view('livewire.screening-table', [
            'data' => $data,
            'ranks' => $ranks
        ]);
    }

}   