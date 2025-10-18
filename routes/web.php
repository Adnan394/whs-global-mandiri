<?php

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganKerja;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CrewingController;
use App\Http\Controllers\DataLamaranController;
use App\Http\Controllers\LamaranSayaController;

Route::get('/', function () {
    return view('welcome', [
        'active' => 'home',
        'karir' => App\Models\LowonganKerja::all(),
    ]);
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register.store');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('registercrewing', [AuthController::class, 'registerCrewing'])->name('registerCrewing');
Route::post('registercrew', [AuthController::class, 'registerCrew'])->name('registerCrew');
Route::get('profile', [AuthController::class, 'profile'])->name('profile');
Route::post('profile', [AuthController::class, 'updateProfile'])->name('update.profile');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('lowongan_kerja/detail/{slug}', [LowonganKerja::class, 'slug'])->name('lowongan_kerja.slug');
    Route::get('lowongan_kerja/pertanyaan/{slug}', [LowonganKerja::class, 'pertanyaan'])->name('lowongan_kerja.pertanyaan');
    Route::post('lowongan_kerja/lamar/{id}', [LowonganKerja::class, 'lamar'])->name('lowongan_kerja.lamar');
    Route::get('lamaran_saya', [LamaranSayaController::class, 'index'])->name('lamaran_saya.index');
    Route::post('kirim_pesan', function(Request $request) {
        $userLamaranId = $request->user_lamaran_id;
        $chat = Chat::where('user_lamaran_id', $userLamaranId)->first();

        if(!empty($chat)) {
            Chat::create([
                'user_id' => Auth::user()->id,
                'user_lamaran_id' => $userLamaranId,
                'message' => $request->message,
                'iteration' => $chat->iteration + 1
            ]);

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }else {
            Chat::create([
                'user_id' => Auth::user()->id,
                'user_lamaran_id' => $userLamaranId,
                'message' => $request->message,
                'iteration' => 0
            ]);

            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        }
    })->name('kirim_pesan');
    

    Route::resource('lowongan', LowonganKerja::class);
    Route::get('lamaran', [DataLamaranController::class, 'index'])->name('lamaran.index');
    Route::post('lamaran/update_status_lamaran/{id}', [DataLamaranController::class, 'update_status'])->name('lamaran.update_status');
    Route::resource('crew', CrewController::class);
    Route::resource('crewing', CrewingController::class);
});