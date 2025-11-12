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
            return redirect()->back()->with('error', 'Crew Sudah Ditambahkan!');
        }
        
        CrewList::create([
            'crew_id' => $request->crew_id,
            'ship_id' => $request->ship_id
        ]);

        return redirect()->route('crew_list.index')->with('success', 'Data Berhasil Ditambahkan!');
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
        $check = CrewList::where('crew_id', $request->crew_id)->first();

        if($check) {
            return redirect()->back()->with('error', 'Crew Sudah Ditambahkan!');
        }

        CrewList::where('id', $id)->update([
            'crew_id' => $request->crew_id,
            'ship_id' => $request->ship_id,
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CrewList::where('id', $id)->delete();
        return redirect()->route('crew_list.index')->with('success', 'Data Berhasil Dihapus!');
    }
}