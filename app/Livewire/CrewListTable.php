<?php

namespace App\Livewire;

use App\Models\crew;
use App\Models\rank;
use App\Models\Ship;
use Livewire\Component;
use App\Models\CrewList;

class CrewListTable extends Component
{
    public $rank_id = ''; // default kosong
    public $status = ''; // default kosong

    public function render()
    {
        $ranks = rank::orderBy('name')->get();

        $query = CrewList::with('crew', 'ship')
            ->join('crews', 'crew_lists.crew_id', '=', 'crews.id')
            ->select('crew_lists.*', 'crews.fullname','crews.standby_on','crews.rank_id','crews.phone', 'crews.standby_on', 'crews.rank_id');
            
        if ($this->rank_id != '') {
            $query->where('crews.rank_id', $this->rank_id);
        }

        if ($this->status != '') {
            $query->where('crews.standby_on', $this->status);
        }

        $data = $query->get();

        return view('livewire.crew-list-table', [
            'data' => $data,
            'ship' => Ship::all(),
            'crew' => crew::where('is_active', 1)->get(),
            'ranks' => $ranks
        ]);
    }
}   