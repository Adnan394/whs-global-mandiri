<?php

namespace App\Exports;

use App\Models\crew;
use App\Models\CrewList;
use App\Models\Ship;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CrewListsExport implements FromCollection, WithHeadings
{

    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }
    public function collection()
    {
        $query = CrewList::join('crews', 'crew_lists.crew_id', 'crews.id')
        ->join('ships', 'crew_lists.ship_id', 'ships.id')
        ->select([
            'crews.fullname', 
            'crews.phone', 
            'crews.standby_on', 
            'crews.rank_id', 
            'ships.name',
            'ships.type',
        ]);

        if(!empty($this->filters['status'])) {
            $query->where('crews.standby_on', $this->filters['status']);
        }

        if(!empty($this->filters['rank_id'])) {
            $query->where('crews.rank_id', $this->filters['rank_id']);
        }
        
        $data = $query->get();

        return $data;
    }

    public function headings(): array
    {
        return [
            'Fullname',
            'Phone',
            'Ship Name',
            'Ship Type',
        ];
    }
}