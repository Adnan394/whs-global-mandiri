<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use App\Models\crew;
use App\Models\CrewList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrewListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crewing.crew_list.index', [
            'active' => 'crew_list',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $check = CrewList::where('crew_id', $request->crew_id)->first();

        if($check) {
            return redirect()->back()->with('error', 'Data List Crew Exist!');
        }
        
        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/crew_list/';
            
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file->move($path, $filename);
        }
        
        CrewList::create([
            'crew_id' => $request->crew_id,
            'ship_id' => $request->ship_id,
            'file' => $filename,
            'status' => 0
        ]);

        return redirect()->route('crew_list.index')->with('success', 'Crew List Successfully Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [];
        
        $filename = '';
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/crew_list/';
            
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $file->move($path, $filename);
            $data['file'] = $filename;
        }
        
        if(!empty($request->crew_id)) {
            $data['crew_id'] = $request->crew_id;
        }
        if(!empty($request->ship_id)) {
            $data['ship_id'] = $request->ship_id;
        }
        if(!empty($request->status)) {
            $data['status'] = $request->status;
        }

        CrewList::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Crew List Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CrewList::where('id', $id)->delete();
        return redirect()->route('crew_list.index')->with('success', 'Crew List Successfully Deleted!');
    }
}