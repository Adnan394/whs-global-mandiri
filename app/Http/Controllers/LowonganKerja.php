<?php

namespace App\Http\Controllers;

use App\Models\rank;
use App\Models\Pertanyaan;
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
            'ranks' => rank::all(),
            'employment_types' => EmploymentType::all(),
            'experience_levels' => ExperienceLevel::all(),
            'active' => 'lowongan_kerja'
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'employment_type' => 'required',
            'experience_level' => 'required',
            'rank_id' => 'required',
            'requirement' => 'required',
            'education' => 'required',
            'sallary' => 'required',
        ]);

        if(!$request->hasFile('image')) {
            dd($request->all());
            throw new \Exception('No image file uploaded!');
        }

        try {
            DB::beginTransaction();

            $lowongan = [
                'title' => $request->title,
                'description' => $request->description,
                'employment_type_id' => $request->employment_type,
                'experience_level_id' => $request->experience_level,
                'rank_id' => $request->rank_id,
                'requirements' => $request->requirement,
                'education' => $request->education,
                'sallary' => $request->sallary,
                'status' => 1,
                'slug' => str_replace(' ', '-', strtolower($request->title)),
                'user_id' => Auth::user()->id
            ];

            if($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();

                $path = public_path('images/lowongan_kerja');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $filename);
                $lowongan['image'] = $filename;
            }

            $data = Lowongan::create($lowongan);
            
            foreach ($request->pertanyaan as $key => $value) {
                Pertanyaan::create([
                    'lowongan_kerja_id' => $data->id,
                    'pertanyaan' => $value
                ]);
            }
            DB::commit();

            return redirect()->route('lowongan.index')->with('success', 'Lowongan Kerja berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            // return redirect()->route('lowongan.index')->with('error', 'Lowongan Kerja gagal ditambahkan!');
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
            'ranks' => rank::all(),
            'employment_types' => EmploymentType::all(),
            'experience_levels' => ExperienceLevel::all(),
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

            $path = public_path('images/lowongan_kerja');
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
        if(!empty($request->employment_type)) {
            $data['employment_type_id'] = $request->employment_type;
        }
        if(!empty($request->experience_level)) {
            $data['experience_level_id'] = $request->experience_level;
        }
        if(!empty($request->rank_id)) {
            $data['rank_id'] = $request->rank_id;
        }
        if(!empty($request->requirement)) {
            $data['requirements'] = $request->requirement;
        }
        if(!empty($request->education)) {
            $data['education'] = $request->education;
        }
        if(!empty($request->sallary)) {
            $data['sallary'] = $request->sallary;
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
            return redirect()->route('lowongan.index')->with('success', 'Lowongan Kerja berhasil diupdate!');
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
            return redirect()->route('lowongan.index')->with('success', 'Lowongan Kerja berhasil dihapus!');
        } catch (\Throwable $th) {
            return redirect()->route('lowongan.index')->with('success', 'Lowongan Kerja berhasil dihapus!');
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
                return redirect('/')->with('success', 'Lamaran Berhasil di Kirim!');
            }else {
                UserLamaran::create([
                    'user_id' => Auth::user()->id,
                    'lowongan_kerja_id' => $id,
                    'status' => 0
                ]);

                DB::commit();
                return redirect('/')->with('success', 'Lamaran Berhasil di Kirim!');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}