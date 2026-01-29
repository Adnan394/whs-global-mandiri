<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SignOnOff;
use App\Models\CrewList;
use App\Models\CrewRotation;
use App\Models\crew;
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
    
    public function draft() {
        $crew = crew::where('user_id', Auth::user()->id)->first();
        $dataAssignment = SignOnOff::where('crew_id', $crew->id)->get();
        $dataCrewList = CrewList::where('crew_id', $crew->id)->get();
        $dataCrewRotation = CrewRotation::where('crew_id', $crew->id)->get();
        return view('crew.lamaran.draft', [
            'data' => UserLamaran::where('user_id', Auth::user()->id)->get(),
            'assignment' => $dataAssignment,
            'crew_list' => $dataCrewList,
            'crew_rotation' => $dataCrewRotation
        ]);
    }
    
    public function uploadAssign($id, Request $request) {
        try{
            $filename = '';
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'ttd_' . $file->getClientOriginalName();
                if($request->name == 'Sign On') {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/signon/';
                }
                else if($request->name == 'Sign Off') {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/signoff/';
                }
                else if($request->name == 'Promotion') {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/promotion/';
                }
                else if($request->name == 'Leave') {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/leave/';
                }
                else if($request->name == 'Change Ship') {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/leave/';
                }
                else {
                    $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/assignment/';
                }
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move($path, $filename);
    
            }
            
            SignOnOff::where('id', $id)->update([
                'file_ttd' => $filename,
                'status' => 1
            ]);
            
            return redirect()->back()->with('success', 'File Uploaded!');
        }
        catch(\Throwable $th) {
            dd($th->getMessage());
        }
    }
    
    public function uploadCrewList($id, Request $request) {
        try{
            $filename = '';
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'ttd_' . $file->getClientOriginalName();
                $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/crew_list/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move($path, $filename);
    
            }
            
            CrewList::where('id', $id)->update([
                'file_ttd' => $filename,
                'status' => 1
            ]);
            
            return redirect()->back()->with('success', 'File Uploaded!');
        }
        catch(\Throwable $th) {
            dd($th->getMessage());
        }
    }
    
    public function uploadCrewRotation($id, Request $request) {
        try{
            $filename = '';
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = 'ttd_' . $file->getClientOriginalName();
                $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/crew_rotation/';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file->move($path, $filename);
    
            }
            
            CrewRotation::where('id', $id)->update([
                'file_ttd' => $filename,
                'status' => 1
            ]);
            
            return redirect()->back()->with('success', 'File Uploaded!');
        }
        catch(\Throwable $th) {
            dd($th->getMessage());
        }
    }
}