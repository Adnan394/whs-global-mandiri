<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CrewExport implements FromCollection, WithHeadings
{
    protected $filters;

    // 🧩 Konstruktor untuk menerima filter dari Livewire / request
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = User::join('crews', 'users.id', '=', 'crews.user_id')
            ->join('ranks', 'crews.rank_id', '=', 'ranks.id')
            ->where('crews.is_active', 1)
            ->select([
                'crews.fullname',
                'users.email',
                'users.image',
                'crews.phone',
                'crews.birth_place',
                'crews.birth_date',
                'crews.gender',
                'crews.religion',
                'crews.marital_status',
                'crews.address',
                'crews.current_address',
                'crews.standby_on',
                'crews.ktp',
                'crews.certificate_of_competency',
                'crews.certificate_of_proficiency',
                'crews.seaferer_medical_certificate',
                'crews.curriculum_vitae',
                'crews.additional_documents',
                'ranks.name as rank_name',
            ]);

        // 🔹 Filter rank_id
        if (!empty($this->filters['rank_id'])) {
            $query->where('crews.rank_id', $this->filters['rank_id']);
        }

        // 🔹 Filter status (Offboard / Onboard)
        if (!empty($this->filters['status'])) {
            $query->where('crews.standby_on', $this->filters['status']);
        }

        $data = $query->get();

        // 🔹 Mapping path file agar jadi URL penuh
        $data = $data->map(function ($value) {
            $value->image = config('app.url') . '/userdata/avatar/' . $value->image;
            $value->ktp = config('app.url') . '/userdata/ktp/' . $value->ktp;
            $value->certificate_of_competency = config('app.url') . '/userdata/coc/' . $value->certificate_of_competency;
            $value->certificate_of_proficiency = config('app.url') . '/userdata/cop/' . $value->certificate_of_proficiency;
            $value->seaferer_medical_certificate = config('app.url') . '/userdata/smc/' . $value->seaferer_medical_certificate;
            $value->curriculum_vitae = config('app.url') . '/userdata/cv/' . $value->curriculum_vitae;
            $value->additional_documents = config('app.url') . '/userdata/additional_documents/' . $value->additional_documents;
            return $value;
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Image',
            'Phone',
            'Birth Place',
            'Birth Date',
            'Gender',
            'Religion',
            'Marital Status',
            'Address',
            'Current Address',
            'Standby On',
            'KTP',
            'Certificate of Competency',
            'Certificate of Proficiency',
            'Seaferer Medical Certificate',
            'Curriculum Vitae',
            'Additional Documents',
            'Rank',
        ];
    }
}