<?php

namespace App\Http\Controllers;

use App\Models\crew;
use App\Models\rank;
use App\Models\crewing;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CrewingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ranks = rank::all(); // ambil semua rank yang ada
        $candidates = Crew::with('rank')->get();

        // hitung jumlah crew per rank (hanya yang ada)
        $candidateGrouping = $candidates
            ->groupBy(fn($crew) => $crew->rank->name)
            ->map(fn($group) => $group->count());

        // bentuk ulang supaya semua rank tetap muncul, walaupun 0
        $finalGrouping = $ranks->mapWithKeys(function ($rank) use ($candidateGrouping) {
            return [$rank->name => $candidateGrouping[$rank->name] ?? 0];
        });

        $summary = crew::all();
        $summaryGrouping = $summary->groupBy(fn($crew) => $crew->standby_on)->map(fn($group) => $group->count());
        // dd($summaryGrouping);

        return view('crewing.index', [
            'active'=> 'dashboard',
            'activeCrew' => crew::all()->count(),
            'candidateGrouping' => $finalGrouping,
            'summaryGrouping' => $summaryGrouping
        ]);
    }

    public function data_crew() {
        return view('crewing.data_crew.index', [
            'active' => 'data_crew',
            'data' => Crew::all(),
        ]);
    }

    public function my_crew() {
        return view('crewing.my_crew.index', [
            'active' => 'my_crew',
            'data' => Crew::where('is_active', 1)->get()
        ]);
    }

    public function data_crew_detail($id, $print=false) {
        return view('crewing.data_crew.detail', [
            'active' => 'data_crew',
            'print' => $print,
            'data' => Crew::with('user')->where('user_id', $id)->first()
        ]);
    }

    public function message() {
        $data = Message::join('crews', 'crews.id', 'messages.crew_id')
                    ->join('crewings', 'crewings.id', 'messages.crewing_id')
                    ->where('crewing_id', Auth::user()->id)
                    ->select(['messages.*', 'crews.fullname as crew_name', 'crewings.fullname as crewing_name'])
                    ->get();
                    
        return view('crewing.message.index', [
            'active' => 'message',
            'crews' => Crew::all(),
            'data' => $data->unique('crew_id')->values(),
        ]);
    }

    public function messageStore(Request $request) {
        $request->validate([
            'crew_id' => 'required',
            'message' => 'required'
        ]);

        $crewing = crewing::where('user_id', Auth::user()->id)->first();
        if($crewing) {
            $check = Message::where('crewing_id', $crewing->id)
                    ->where('crew_id', $request->crew_id)->first();
        }else {
            $check = Message::where('crewing_id', $request->crewing_id)
                    ->where('crew_id', $request->crew_id)->first();
        }

        if($check) {
            $message = new Message();
            $message->crewing_id = $crewing->id ?? $request->crewing_id;
            $message->crew_id = $request->crew_id;
            $message->user_id = Auth::user()->id;
            $message->message = $request->message;
            $message->iteration = $check->iteration + 1;
            $message->save();
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }else {
            $message = new Message();
            $message->crewing_id = $crewing->id ?? $request->crewing_id;
            $message->crew_id = $request->crew_id;
            $message->user_id = Auth::user()->id;
            $message->message = $request->message;
            $message->iteration = 0;
            $message->save();
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }

        return redirect()->back()->with('error', 'Pesan gagal dikirim!');
    }

    public function messageBroadcast(Request $request)  {
        $crewing = crewing::where('user_id', Auth::user()->id)->first();

        try {
            foreach ($request->crew_id as $key => $value) {
                $check = Message::where('crewing_id', $crewing->id)
                        ->where('crew_id', $value)->first();
        
                if($check) {
                    $message = new Message();
                    $message->crewing_id = $crewing->id;
                    $message->crew_id = $value;
                    $message->user_id = Auth::user()->id;
                    $message->message = $request->message;
                    $message->iteration = $check->iteration + 1;
                    $message->save();
                }else {
                    $message = new Message();
                    $message->crewing_id = $crewing->id;
                    $message->crew_id = $value;
                    $message->user_id = Auth::user()->id;
                    $message->message = $request->message;
                    $message->iteration = 0;
                    $message->save();
                }
            }
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Pesan gagal dikirim!');
        }
    }
}