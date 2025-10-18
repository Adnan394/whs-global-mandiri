<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use App\Models\User;
use App\Models\UserLamaran;
use Illuminate\Http\Request;

class DataLamaranController extends Controller
{
    public function index() {
        return view('crewing.lamaran.index', [
            'data' => UserLamaran::all(),
            'active' => 'lamaran'
        ]);
    }

    public function update_status(Request $request, string $id) {
        UserLamaran::where('id', $id)->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }
}