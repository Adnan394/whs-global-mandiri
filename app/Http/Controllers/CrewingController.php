<?php

namespace App\Http\Controllers;

use App\Models\crew;
use App\Models\rank;
use App\Models\User;
use App\Models\SignOnOff;
use App\Models\crewing;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
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
        $ranks = rank::where('type', 1)->get();
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
        
        $allTitles = [
            'Sign On',
            'Sign Off',
            'Promotion',
            'Leave',
            'Change Ship'
        ];
        
        $assignment = SignOnOff::all();
        
        // hitung berdasarkan name yang ada di DB
        $assignmentGrouping = $assignment
            ->groupBy(fn($crew) => $crew->name)
            ->map(fn($group) => $group->count());
        
        // isi title yang tidak ada dengan default 0
        $finalAssignment = collect($allTitles)->mapWithKeys(function($title) use ($assignmentGrouping) {
            return [$title => $assignmentGrouping[$title] ?? 0];
        });
        
        // dd($final);


        return view('crewing.index', [
            'active'=> 'dashboard',
            'activeCrew' => crew::all()->count(),
            'candidateGrouping' => $finalGrouping,
            'summaryGrouping' => $summaryGrouping,
            'assignment' => $finalAssignment
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
            'data' => crew::leftJoin('sign_on_offs', 'sign_on_offs.crew_id', '=', 'crews.id')
                ->where('sign_on_offs.type', 0)
                ->where('status', 2)
                ->get()
        ]);
    }

    public function data_crew_detail($id, $print=false) {
        return view('crewing.data_crew.detail', [
            'active' => 'data_crew',
            'print' => $print,
            'data' => Crew::with('user')->where('user_id', $id)->first()
        ]);
    }

    public function data_crew_detail_download($id, $print=false) {
        return view('crewing.data_crew.download', [
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
            return redirect()->back()->with('success', 'Send Message Successfully!');
        }else {
            $message = new Message();
            $message->crewing_id = $crewing->id ?? $request->crewing_id;
            $message->crew_id = $request->crew_id;
            $message->user_id = Auth::user()->id;
            $message->message = $request->message;
            $message->iteration = 0;
            $message->save();
            return redirect()->back()->with('success', 'Send Message Successfully!');
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
            return redirect()->back()->with('success', 'Send Message Successfully!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->with('error', 'Send Message Failed!');
        }
    }
    
    public function profile() {
        return view('crewing.profile', [
            'active' => 'profile',
            'user' => Auth::user(),
            'crew' => crewing::where('user_id', Auth::user()->id)->first(),
        ]);
    }
    public function updateProfile(Request $request) {
        $crew = [];
        $user = [];
        if(!empty($request->name)) {
            $user['name'] = $request->name;
            $crew['fullname'] = $request->name;
        }
        if(!empty($request->nickname)) {
            $crew['nickname'] = $request->nickname;
        }
        if(!empty($request->email)) {
            $user['email'] = $request->email;
        }
        if(!empty($request->phone)) {
            $crew['phone'] = $request->phone;
        }
        if($request->hasFile('card_id')) {
            $card_id = $request->file('card_id');
            $filename = $card_id->getClientOriginalName() . '.' . $card_id->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . 'userdata/card_id/';
            $card_id->move($path, $filename);
            $crew['card_id'] = $filename;
        }

        try {
            DB::beginTransaction();
            User::where('id', Auth::user()->id)->update($user);
            crewing::where('user_id', Auth::user()->id)->update($crew);
            DB::commit();
            return redirect()->route('profile')->with('success', '✅ Profile updated successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}