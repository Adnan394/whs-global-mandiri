<?php

namespace App\Livewire;

use App\Models\crew;
use App\Models\rank;
use Livewire\Component;
use App\Models\UserLamaran;

class ScreeningTable extends Component
{
    public $year = '';
    public $month = '';

    public $years = [];
    public $months = [
        '01' => 'January',
        '02' => 'February',
        '03' => 'March',
        '04' => 'April',
        '05' => 'May',
        '06' => 'June',
        '07' => 'July',
        '08' => 'August',
        '09' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];
    
    public function mount()
    {
        // Buat list tahun dari sekarang ke 2020
        $this->years = range(date('Y'), 2015);
    }

    public function render()
    {
        $ranks = rank::orderBy('name')->get();
        $query = UserLamaran::query();

        // 🔥 Filter berdasarkan tahun + bulan baru
        if (!empty($this->year)) {
            $query->whereYear('created_at', $this->year);
        }

        if (!empty($this->month)) {
            $query->whereMonth('created_at', $this->month);
        }

        $data = $query->get();

        return view('livewire.screening-table', [
            'data' => $data,
            'ranks' => $ranks,
            'years' => $this->years
        ]);
    }
}
