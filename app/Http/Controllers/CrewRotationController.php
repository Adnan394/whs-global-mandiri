<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\crew;
use App\Models\CrewRotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CrewList;

class CrewRotationController extends Controller
{
    public function index() {
        return view('crewing.crew_rotation.index', [
            'active' => 'crewrotation',
            'data' => CrewRotation::all()
        ]);
    }

    public function create() {
        $crew = crew::join('crew_lists', 'crews.id', 'crew_lists.crew_id')->where('crew_lists.status', 2)->get();
        return view('crewing.crew_rotation.create', [
            'active' => 'crewrotation',
            'crews' => $crew,
            'ships' => Ship::all()
        ]);
    }

    public function store(Request $request) {
        $crewList = CrewList::where('crew_id', $request->crew_id)->first();

        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/user_rotation/';
            if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
            $file->move($path, $filename);
        }

        
        if(isset($crewList)) {
            crew::where('id', $request->crew_id)->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            CrewList::where('id', $crewList->id)->update([
                'ship_id' => $request->ship_id
            ]);
        }else {
            crew::where('id', $request->crew_id)->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            CrewList::create([
                'crew_id' => $request->crew_id,
                'ship_id' => $request->ship_id
            ]);
        }

        CrewRotation::create([
            'crew_id' => $request->crew_id,
            'ship_id' => $request->ship_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'name' => $request->name,
            'file' => $filename,
            'status' => 0,
            'duration' => date_diff(date_create_from_format('Y-m-d', $request->end_date), date_create_from_format('Y-m-d', $request->start_date))->format('%a Hari %h Jam %i Menit')
        ]);

        return redirect()->route('crew_rotation.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id) {
        $crew = crew::join('crew_lists', 'crews.id', 'crew_lists.crew_id')->where('crew_lists.status', 2)->get();
        return view('crewing.crew_rotation.edit', [
            'active' => 'crewrotation',
            'data' => CrewRotation::where('id', $id)->first(),
            'crews' => $crew,
            'ships' => Ship::all()
        ]);
    }

    public function update(Request $request, $id) {
        $crewList = CrewList::where('crew_id', $request->crew_id)->first();

        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/user_rotation/';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file->move($path, $filename);
        }

        if(isset($crewList)) {
            crew::where('id', $request->crew_id)->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            CrewList::where('id', $crewList->id)->update([
                'ship_id' => $request->ship_id
            ]);
        }else {
            crew::where('id', $request->crew_id)->update([
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            CrewList::create([
                'crew_id' => $request->crew_id,
                'ship_id' => $request->ship_id
            ]);
        }

        $payload  = [];
        $query = CrewRotation::where('id', $id);
        if(isset($request->crew_id)) {
            $payload['crew_id'] = $request->crew_id;
        }
        if(isset($request->ship_id)) {
            $payload['ship_id'] = $request->ship_id;
        }
        if(isset($request->start_date)) {
            $payload['start_date'] = $request->start_date;
        }
        if(isset($request->end_date)) {
            $payload['end_date'] = $request->end_date;
        }
        if(isset($request->name)) {
            $payload['name'] = $request->name;
        }
        if(isset($request->file)) {
            $payload['file'] = $filename;
        }
        if(isset($request->status)) {
            $payload['status'] = $request->status;
        }
        
        if(isset($request->start_date) && isset($request->end_date)) {
            $payload['duration'] = date_diff(date_create_from_format('Y-m-d', $request->end_date), date_create_from_format('Y-m-d', $request->start_date))->format('%a Hari %h Jam %i Menit');
        }
        $query->update($payload);

        return redirect()->route('crew_rotation.index')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id) {
        CrewRotation::where('id', $id)->delete();
        return redirect()->route('crew_rotation.index')->with('success', 'Data berhasil dihapus!');
    }
}