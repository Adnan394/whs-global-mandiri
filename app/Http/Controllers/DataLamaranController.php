<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\crew;
use App\Models\User;
use App\Models\Pertanyaan;
use App\Models\UserLamaran;
use Illuminate\Http\Request;
use App\Models\UserInterview;
use Illuminate\Support\Facades\Auth;

class DataLamaranController extends Controller
{
    public function index() {
        return view('crewing.lamaran.index', [
            'active' => 'lamaran'
        ]);
    }

    public function update_status(Request $request, string $id) {
        UserLamaran::where('id', $id)->update([
            'status' => $request->status
        ]);

        if($request->status == 2) {
            UserInterview::create([
                'user_lamaran_id' => $id,
                'date' => $request->date_interview,
                'time' => $request->time_interview
            ]);
        }

        if($request->status == 3) {
            $userLamaran = UserLamaran::where('id', $id)->first();

            crew::where('user_id', $userLamaran->user_id)->update([
                'is_active' => 1
            ]);
        }

        $chat = Chat::where('user_lamaran_id', $id)->first();

        if(!empty($chat)) {
            Chat::create([
                'user_id' => Auth::user()->id,
                'user_lamaran_id' => $id,
                'message' => $request->pesan,
                'iteration' => $chat->iteration + 1
            ]);

            if($request->status == 2) {
                $pesan = 'Jangan lupa untuk menghadiri interview pada tanggal '.$request->date_interview.' dan waktu '.$request->time_interview.'!';
                Chat::create([
                    'user_id' => Auth::user()->id,
                    'user_lamaran_id' => $id,
                    'message' => $pesan,
                    'iteration' => $chat->iteration + 2
                ]);
            }

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }else {
            Chat::create([
                'user_id' => Auth::user()->id,
                'user_lamaran_id' => $id,
                'message' => $request->pesan,
                'iteration' => 0
            ]);

            if($request->status == 2) {
                $pesan = 'Jangan lupa untuk menghadiri interview pada tanggal '.$request->date_interview.' dan waktu '.$request->time_interview.'!';
                Chat::create([
                    'user_id' => Auth::user()->id,
                    'user_lamaran_id' => $id,
                    'message' => $pesan,
                    'iteration' => 1
                ]);
            }

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }
        return redirect()->back();
    }
}