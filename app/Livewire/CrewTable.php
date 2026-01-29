<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\crew;
use App\Models\rank;

class CrewTable extends Component
{
    public $rank_id = ''; // default kosong
    public $status = ''; // default kosong

    public function render()
    {
        $ranks = rank::where('type', 1)->orderBy('name')->get();

        // $query = crew::where('is_active', 1);
        $query = crew::leftJoin('sign_on_offs', 'sign_on_offs.crew_id', '=', 'crews.id')
                ->where('sign_on_offs.name', 'Sign On')
                ->where('status', 2);

        if ($this->rank_id != '') {
            $query->where('rank_id', $this->rank_id);
        }

        if ($this->status != '') {
            $query->where('standby_on', $this->status);
        }

        $data = $query->get();

        return view('livewire.crew-table', [
            'data' => $data,
            'ranks' => $ranks
        ]);
    }
}   