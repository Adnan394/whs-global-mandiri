<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLamaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranSayaController extends Controller
{
    public function index() {
        return view('crew.lamaran.index', [
            'data' => UserLamaran::where('user_id', Auth::user()->id)->get()
        ]);
    }
}