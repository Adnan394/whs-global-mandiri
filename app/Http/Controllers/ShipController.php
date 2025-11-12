<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('crewing.ship.index', [
            'active' => 'ship',
            'data' => Ship::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crewing.ship.create', [
            'active' => 'ship'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ship::create([
            'name' => $request->nama,
            'flag' => $request->bendera,
            'capacity' => $request->kapasitas,
            'type' => $request->tipe,
            'status' => $request->status
        ]);

        return redirect()->route('ship.index')->with('success', 'Data Berhasil Ditambahkan!');
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
        return view('crewing.ship.edit', [
            'active' => 'ship',
            'data' => Ship::where('id', $id)->first()   
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Ship::where('id', $id)->update([
            'name' => $request->nama,
            'flag' => $request->bendera,
            'capacity' => $request->kapasitas,
            'type' => $request->tipe,
            'status' => $request->status
        ]);

        return redirect()->route('ship.index')->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ship::where('id', $id)->delete();
        return redirect()->route('ship.index')->with('success', 'Data Berhasil Dihapus!');
    }
}