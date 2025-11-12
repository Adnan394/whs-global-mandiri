<?php

namespace App\Http\Controllers;

use App\Models\SignOnOff;
use App\Models\crew;
use App\Models\rank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignOnOffController extends Controller
{
    public function index() {
        return view('crewing.signonoff.index', [
            'active' => 'signonoff',
            'data' => SignOnOff::all()
        ]);
    }

    public function create() {
        return view('crewing.signonoff.create', [
            'active' => 'signonoff',
            'crews' => crew::where('is_active', 1)->get(),
            'ranks' => rank::all()
        ]);
    }

    public function store(Request $request) {
        $crewExist = crew::where('id', $request->crew_id)->first();
        if(empty($crewExist)) {
            return redirect()->back()->with('error', 'Crew Tidak Ditemukan!');
        }
        $rankExist = rank::where('id', $request->rank_id)->first();
        if(empty($rankExist)) {
            return redirect()->back()->with('error', 'Rank Tidak Ditemukan!');
        }

        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            if($request->name == 'Sign On') {
                $path = public_path('userdata/signon/');
            }else {
                $path = public_path('userdata/promot/');
            }
            $file->move($path, $filename);
        }

        SignOnOff::create([
            'name' => $request->name,
            'crew_id' => $request->crew_id,
            'rank_id' => $request->rank_id,
            'file' => $filename,
        ]);

        if($request->name == 'Promot Rank') {
            crew::where('id', $request->crew_id)->update([
                'rank_id' => $request->rank_id
            ]);
        }

        return redirect('/signonoff')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function edit($id) {
        return view('crewing.signonoff.edit', [
            'active' => 'signonoff',
            'data' => SignOnOff::where('id', $id)->first(),
            'crews' => crew::where('is_active', 1)->get(),
            'ranks' => rank::all()
        ]);
    }

    public function update(Request $request, $id) {
        $crewExist = crew::where('id', $request->crew_id)->first();
        if(empty($crewExist)) {
            return redirect()->back()->with('error', 'Crew Tidak Ditemukan!');
        }
        $rankExist = rank::where('id', $request->rank_id)->first();
        if(empty($rankExist)) {
            return redirect()->back()->with('error', 'Rank Tidak Ditemukan!');
        }

        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            if($request->name == 'Sign On') {
                $path = public_path('userdata/signon/');
            }else {
                $path = public_path('userdata/promot/');
            }
            $file->move($path, $filename);
        }

        $query = SignOnOff::where('id', $id);
        $payload = [];

        if(isset($request->crew_id)) {
            $payload['crew_id'] = $request->crew_id;
        }
        if(isset($request->rank_id)) {
            $payload['rank_id'] = $request->rank_id;
        }
        if(isset($request->file)) {
            $payload['file'] = $filename;
        }
        if(isset($request->name)) {
            $payload['name'] = $request->name;
        }
        $query->update($payload);
        
        if($request->name == 'Promot Rank') {
            crew::where('id', $request->crew_id)->update([
                'rank_id' => $request->rank_id
            ]);
        }

        return redirect('/signonoff')->with('success', 'Data Berhasil Diubah!');
    }

    public function destroy($id) {
        SignOnOff::where('id', $id)->delete();
        return redirect('/signonoff')->with('success', 'Data Berhasil Dihapus!');
    }
}