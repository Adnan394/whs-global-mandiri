<?php

namespace App\Exports;

use App\Models\UserLamaran;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserLamaransExport implements FromCollection, WithHeadings
{

    protected $filters;
    public function __construct($filters = [])
    {   
        $this->filters = $filters;
    }
    public function collection()
    {
        $query = UserLamaran::join('users', 'user_lamarans.user_id', 'users.id')
        ->join('crews', 'crews.user_id', 'users.id')
        ->join('lowongan_kerjas', 'lowongan_kerjas.id', 'user_lamarans.lowongan_kerja_id')
        ->select([
            'crews.fullname', 
            'crews.phone', 
            'lowongan_kerjas.title',
            'user_lamarans.status',
        ]);
        
         // 🔸 Filter rank (kalau dipilih)
        if (!empty($this->filters['month'])) {
            [$year, $month] = explode('-', $this->filters['month']);
            $query->whereYear('user_lamarans.created_at', $year)
            ->whereMonth('user_lamarans.created_at', $month);
        }
        $data = $query->get();

        $data = $data->map(function($item) {
            if($item->status == '0') {
                $item->status = 'Process';
            } elseif($item->status == '2') {
                $item->status = 'Interview';
            } elseif($item->status == '3') {
                $item->status = 'Accepted';
            }else {
                $item->status = 'Decline';
            }

            return $item;
        }, $data);

        return $data;
    }

    public function headings(): array
    {
        return [
            'Fullname',
            'Phone',
            'Title',
            'Status',
        ];
    }
}