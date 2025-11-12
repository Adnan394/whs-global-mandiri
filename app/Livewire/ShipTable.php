<?php

namespace App\Livewire;
use App\Models\Ship;
use Livewire\Component;

class ShipTable extends Component
{
    public $status = ''; // default kosong

    public function render()
    {
        $query = Ship::query();
        
        if ($this->status != '') {
            $query->where('status', $this->status);
        }

        $data = $query->get();

        return view('livewire.ship-table', [
            'data' => $data,
        ]);
    }

}   