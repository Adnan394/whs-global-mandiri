<?php

namespace App\Http\Controllers;

use App\Models\rank;
use App\Models\Pertanyaan;
use App\Models\crew;
use Illuminate\Http\Request;
use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\LowonganKerja as Lowongan;
use App\Models\User;
use App\Models\UserLamaran;
use App\Models\UserPertanyaan;

class LowonganKerja extends Controller
{
    // ADMIN ZONE 
    public function index()
    {
        return view('crewing.lowongan_kerja.index', [
            'active' => 'lowongan_kerja',
            'data' => Lowongan::orderBy('created_at', 'desc')->get()
        ]);
    }
    public function create()
    {
        return view('crewing.lowongan_kerja.create', [
            'ranks' => rank::where('type', 1)->get(),
            'employment_types' => EmploymentType::all(),
            'experience_levels' => ExperienceLevel::all(),
            'active' => 'lowongan_kerja'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rank_id' => 'required',
            'sallary' => 'required',
            'sallary2' => 'required',
        ]);

        if(!$request->hasFile('image')) {
            return redirect()->route('lowongan.index')->with('error', 'No image file uploaded!');
        }

        try {
            DB::beginTransaction();

            $lowongan = [
                'title' => $request->title,
                'description' => $request->description,
                'rank_id' => $request->rank_id,
                'sallary' => $request->sallary,
                'sallary2' => $request->sallary2,
                'status' => 1,
                'slug' => str_replace(' ', '-', strtolower($request->title)),
                'user_id' => Auth::user()->id
            ];

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();

                $path = $_SERVER['DOCUMENT_ROOT'] . '/images/lowongan_kerja';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $filename);
                $lowongan['image'] = $filename;
            }

            $data = Lowongan::create($lowongan);
            
            if($request->pertanyaan) {
                foreach ($request->pertanyaan as $key => $value) {
                    Pertanyaan::create([
                        'lowongan_kerja_id' => $data->id,
                        'pertanyaan' => $value
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('lowongan.index')->with('success', 'Job Vacancy Successfully Added!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('lowongan.index')->with('error', 'Lowongan Kerja gagal ditambahkan!');
            throw $th;
        }
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        return view('crewing.lowongan_kerja.edit', [
            'lowongan' => Lowongan::find($id),
            'ranks' => rank::where('type', 1)->get(),
            'active' => 'lowongan_kerja',
            'lowongan' => Lowongan::find($id),
            'pertanyaan' => Pertanyaan::where('lowongan_kerja_id', $id)->get()
        ]);
    }
    public function update(Request $request, string $id)
    {
        $data = [];

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            $path = $_SERVER['DOCUMENT_ROOT'] . '/images/lowongan_kerja';
            // $path = public_path('images/lowongan_kerja');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);
            $data['image'] = $filename;
        }

        if(!empty($request->title)) {
            $data['title'] = $request->title;
        }
        if(!empty($request->description)) {
            $data['description'] = $request->description;
        }
        if(!empty($request->rank_id)) {
            $data['rank_id'] = $request->rank_id;
        }
        if(!empty($request->sallary)) {
            $data['sallary'] = $request->sallary;
        }
        if(!empty($request->sallary2)) {
            $data['sallary2'] = $request->sallary2;
        }
        if(!empty($request->status)) {
            $data['status'] = $request->status;
        }
        if(!empty($request->slug)) {
            $data['slug'] = str_replace(' ', '-', strtolower($request->title));
        }

        try {
            DB::beginTransaction();
            Lowongan::where('id', $id)->update($data);

            $dataPertanyaan = Pertanyaan::where('lowongan_kerja_id', $id)->get();
            foreach ($dataPertanyaan as $key => $value) {
                if(!in_array($value->id, $request->pertanyaan_id)) {
                    Pertanyaan::find($value->id)->delete();
                }
            }
            
            // === Handle Pertanyaan ===
            $ids = $request->pertanyaan_id ?? [];
            $texts = $request->pertanyaan_text ?? [];

            foreach ($texts as $i => $text) {
                $idPertanyaan = $ids[$i];

                if ($idPertanyaan) {
                    // kalau ada ID → update pertanyaan lama
                    $pertanyaan = Pertanyaan::find($idPertanyaan);
                    if ($pertanyaan) {
                        $pertanyaan->update(['pertanyaan' => $text]);
                    }
                } else {
                    // kalau tidak ada ID → ini pertanyaan baru
                    Pertanyaan::create([
                        'lowongan_kerja_id' => $id,
                        'pertanyaan' => $text
                    ]);
                }
            }
            
            DB::commit();
            return redirect()->route('lowongan.index')->with('success', 'Job Vacancy Successfully Updated!');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
            return redirect()->route('lowongan.index')->with('error', 'Lowongan Kerja gagal diupdate!');
        }
    }
    public function destroy(string $id)
    {
        try {
            Pertanyaan::where('lowongan_kerja_id', $id)->delete();
            Lowongan::find($id)->delete();
            return redirect()->route('lowongan.index')->with('success', 'Job Vacancy Successfully Deleted!');
        } catch (\Throwable $th) {
            return redirect()->route('lowongan.index')->with('error', 'Job Vacancy Fail to Deleted');
        }
    }


    // CLIENT ZONE

    public function slug(string $slug) {
        return view('crew.lowongan.detail', [
            'active' => 'lowongan_kerja',
            'lowongan' => Lowongan::where('slug', $slug)->first(),
        ]);
    }

    public function pertanyaan(string $slug) {
        if(!Auth::user()->image) {
            return redirect('/profile')->with('error', 'Please Complete Your Profile!');
        }
        $crew = User::with('crew')->where('id', Auth::user()->id)->first();
        if(!$crew->crew->birth_place || !$crew->crew->birth_date || !$crew->crew->gender || !$crew->crew->religion || !$crew->crew->marital_status || !$crew->crew->address || !$crew->crew->current_address || !$crew->crew->ktp || !$crew->crew->certificate_of_competency || !$crew->crew->certificate_of_proficiency || !$crew->crew->seaferer_medical_certificate || !$crew->crew->curriculum_vitae) 
        {
            return redirect('/profile')->with('error', 'Please Complete Your Profile!');
        }
        
        $lowongan = Lowongan::where('slug', $slug)->first();
        return view('crew.lowongan.pertanyaan', [
            'lowongan' => $lowongan,
            'data' => Pertanyaan::where('lowongan_kerja_id', $lowongan->id)->get(),
        ]);
    }
    public function lamar(Request $request, string $id) {
        try {
            DB::beginTransaction();
            if(isset($request->answer)) {
                foreach ($request->answer as $key => $value) {
                    UserPertanyaan::create([
                       'user_id' => Auth::user()->id,
                       'pertanyaan_id' => Pertanyaan::find($key)->id,
                       'jawaban' => $value
                    ]);
                }
                UserLamaran::create([
                    'user_id' => Auth::user()->id,
                    'lowongan_kerja_id' => $id,
                    'status' => 0
                ]);

                DB::commit();
                return redirect('/')->with('success', 'Application Successfully Applied!');
            }else {
                UserLamaran::create([
                    'user_id' => Auth::user()->id,
                    'lowongan_kerja_id' => $id,
                    'status' => 0
                ]);

                DB::commit();
                return redirect('/')->with('success', 'Application Successfully Applied!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}