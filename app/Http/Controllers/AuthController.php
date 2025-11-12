<?php

namespace App\Http\Controllers;

use App\Models\crew;
use App\Models\rank;
use App\Models\User;
use App\Models\crewing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($validatedData)) {
            return back()->with('status', 'Login gagal, perikas username dan password anda!');
        }

        if(Auth::user()->role == 'crew') {
            return redirect('/')->with('success', 'Login Berhasil');
        }else if(Auth::user()->role == 'crewing') {
            return redirect('/crewing')->with('success', 'Login Berhasil');
        } else {
            return redirect()->back()->with('status', 'Login gagal, perikas username dan password anda!');
        }
    }

    public function register() {
        
        return view('auth.register', [
            'ranksCrew' => rank::where('type', 1)->get(),
            'ranksCrewing' => rank::where('type', 2)->get()
        ]);
    }

    
    public function registerCrewing(Request $request)
    {
        try {
            Log::info('registerCrewing called', $request->all());

            $request->validate([
                'fullname' => 'required',
                'nickname' => 'required',
                'phone' => 'required',
                'email' => 'required|email:dns|unique:users',
                'card_id' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'rank_id' => 'required|exists:ranks,id',
            ]);

            DB::beginTransaction();

            if (!$request->hasFile('card_id')) {
                throw new \Exception('No image file uploaded!');
            }

            $image = $request->file('card_id');
            $filename = time() . '_' . $image->getClientOriginalName();

            $path = public_path('image/id_card');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $image->move($path, $filename);

            $user = User::create([
                'name' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'crewing',
            ]);

            Crewing::create([
                'user_id' => $user->id,
                'fullname' => $request->fullname,
                'nickname' => $request->nickname,
                'phone' => $request->phone,
                'card_id' => $filename,
                'rank_id' => $request->rank_id,
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', '✅ Crewing registered successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('registerCrewing error: ' . $th->getMessage());
            return back()->with('error', '❌ ' . $th->getMessage());
        }
    }

    public function registerCrew(Request $request)
    {
        try {
            Log::info('registerCrew called', $request->all());

            $request->validate([
                'fullname' => 'required',
                'nickname' => 'required',
                'phone' => 'required',
                'email' => 'required|email:dns|unique:users',
                'rank_id' => 'required|exists:ranks,id',
            ]);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'crew',
            ]);

            Crew::create([
                'user_id' => $user->id,
                'fullname' => $request->fullname,
                'nickname' => $request->nickname,
                'phone' => $request->phone,
                'rank_id' => $request->rank_id,
            ]);

            DB::commit();
            return redirect()->route('login')->with('success', '✅ Crew registered successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('registerCrew error: ' . $th->getMessage());
            return back()->with('error', '❌ ' . $th->getMessage());
        }
    }

    public function profile() {
        return view('auth.profile', [
            'user' => Auth::user(),
            'crew' => Crew::where('user_id', Auth::user()->id)->first(),
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
        if(!empty($request->birth_date)) {
            $crew['birth_date'] = $request->birth_date;
        }
        if(!empty($request->birth_place)) {
            $crew['birth_place'] = $request->birth_place;
        }
        if(!empty($request->gender)) {
            $crew['gender'] = $request->gender;
        }
        if(!empty($request->religion)) {
            $crew['religion'] = $request->religion;
        }
        if(!empty($request->address)) {
            $crew['address'] = $request->address;
        }
        if(!empty($request->current_address)) {
            $crew['current_address'] = $request->current_address;
        }
        if(!empty($request->marital_status)) {
            $crew['marital_status'] = $request->marital_status;
        }

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
            $path = public_path('userdata/avatar/');
            $image->move($path, $filename);
            $user['image'] = $filename;
        }
        if($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $filename = $ktp->getClientOriginalName() . '.' . $ktp->getClientOriginalExtension();
            $path = public_path('userdata/ktp/');
            $ktp->move($path, $filename);
            $crew['ktp'] = $filename;
        }
        if($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $filename = $cv->getClientOriginalName() . '.' . $cv->getClientOriginalExtension();
            $path = public_path('userdata/cv/');
            $cv->move($path, $filename);
            $crew['curriculum_vitae'] = $filename;
        }
        if($request->hasFile('coc')) {
            $coc = $request->file('coc');
            $filename = $coc->getClientOriginalName() . '.' . $coc->getClientOriginalExtension();
            $path = public_path('userdata/coc/');
            $coc->move($path, $filename);
            $crew['certificate_of_competency'] = $filename;
        }
        if($request->hasFile('cop')) {
            $cop = $request->file('cop');
            $filename = $cop->getClientOriginalName() . '.' . $cop->getClientOriginalExtension();
            $path = public_path('userdata/cop/');
            $cop->move($path, $filename);
            $crew['certificate_of_proficiency'] = $filename;
        }
        if($request->hasFile('smc')) {
            $smc = $request->file('smc');
            $filename = $smc->getClientOriginalName() . '.' . $smc->getClientOriginalExtension();
            $path = public_path('userdata/smc/');
            $smc->move($path, $filename);
            $crew['seaferer_medical_certificate'] = $filename;
        }
        if($request->hasFile('additional_document')) {
            $additional_document = $request->file('additional_document');
            $filename = $additional_document->getClientOriginalName() . '.' . $additional_document->getClientOriginalExtension();
            $path = public_path('userdata/additional_document/');
            $additional_document->move($path, $filename);
            $crew['additional_documents'] = $filename;
        }

        try {
            DB::beginTransaction();
            User::where('id', Auth::user()->id)->update($user);
            Crew::where('user_id', Auth::user()->id)->update($crew);
            DB::commit();
            return redirect()->route('profile')->with('success', '✅ Profile updated successfully!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function changeStatus(Request $request) {
        crew::where('user_id', $request->id)->update([
            'standby_on' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Crew Update Successfully!');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}