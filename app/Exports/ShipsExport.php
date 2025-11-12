<?php

namespace App\Exports;

use App\Models\crew;
use App\Models\Ship;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ShipsExport implements FromCollection, WithHeadings
{

    protected $filters;
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }
    public function collection()
    {
        $query = Ship::select([
            'name',
            'type',
            'flag',
            'status',
        ]);

        if(!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        
        $data = $query->get();
        
        $data = $data->map(function ($value) {
            if($value->status == 0) {
                $value->status = 'standby';
            }else if($value->status == 1) {
                $value->status = 'docking';
            }else {
                $value->status = 'operation';
            }

            return $value;
        }, $data);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Type',
            'Flag',
            'Status',
        ];
    }
}