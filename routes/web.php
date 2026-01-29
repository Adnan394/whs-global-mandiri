<?php

use App\Models\Chat;
use App\Models\CrewRotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LowonganKerja;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\CrewingController;
use App\Http\Controllers\CrewListController;
use App\Http\Controllers\DataCrewController;
use App\Http\Controllers\SignOnOffController;
use App\Http\Controllers\DataLamaranController;
use App\Http\Controllers\LamaranSayaController;
use App\Http\Controllers\CrewRotationController;

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
Route::get('change-password', [AuthController::class, 'changePassword'])->name('change_password');
Route::post('change-password', [AuthController::class, 'changePasswordStore'])->name('change_password.store');

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot_password');
Route::post('forgot-password', [AuthController::class, 'forgotPasswordStore'])->name('forgot_password.store');
Route::get('reset-passsword/{token}', [AuthController::class, 'resetPassword'])->name('reset_password');
Route::post('reset-passsword', [AuthController::class, 'resetPasswordStore'])->name('reset_password.store');

Route::post('change-status', [AuthController::class, 'changeStatus'])->name('changeStatus');
Route::get('/export-crew', [ExportController::class, 'exportCrew'])->name('export.crew');
Route::get('/export-crewing', [ExportController::class, 'exportCrewing'])->name('export.crewing');
Route::get('/export-ship', [ExportController::class, 'exportShip'])->name('export.ship');
Route::get('/export-crew-list', [ExportController::class, 'exportCrewList'])->name('export.crew_list');
Route::get('/export-screening', [ExportController::class, 'exportScreening'])->name('export.screening');


Route::group(['middleware' => 'auth'], function () {
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

            return redirect()->back()->with('success', 'Send Message Successfully!');
        }else {
            Chat::create([
                'user_id' => Auth::user()->id,
                'user_lamaran_id' => $userLamaranId,
                'message' => $request->message,
                'iteration' => 0
            ]);

            return redirect()->back()->with('success', 'Send Message Successfully!');
        }
    })->name('kirim_pesan');
    
    Route::get('lowongan_kerja/detail/{slug}', [LowonganKerja::class, 'slug'])->name('lowongan_kerja.slug');
    Route::get('lowongan_kerja/pertanyaan/{slug}', [LowonganKerja::class, 'pertanyaan'])->name('lowongan_kerja.pertanyaan');
    Route::post('lowongan_kerja/lamar/{id}', [LowonganKerja::class, 'lamar'])->name('lowongan_kerja.lamar');
    Route::get('lamaran_saya', [LamaranSayaController::class, 'index'])->name('lamaran_saya.index');
    Route::get('lamaran_saya/draft', [LamaranSayaController::class, 'draft'])->name('lamaran_saya.draft');
    Route::post('lamaran_saya/uplaod_assignment/{id}', [LamaranSayaController::class, 'uploadAssign'])->name('lamaran_saya.upload_assign');
    Route::post('lamaran_saya/upload_crew_list/{id}', [LamaranSayaController::class, 'uploadCrewList'])->name('lamaran_saya.upload_crew_list');
    Route::post('lamaran_saya/crew_rotation/{id}', [LamaranSayaController::class, 'uploadCrewRotation'])->name('lamaran_saya.crew_rotation');
    Route::get('crewing/data_crew', [CrewingController::class, 'data_crew'])->name('data_crew');
    Route::get('crewing/my_crew', [CrewingController::class, 'my_crew'])->name('my_crew');
    Route::get('crewing/data_crew/delete/{id}', [CrewingController::class, 'data_crew_delete'])->name('data_crew.destroy');
    Route::get('crewing/data_crew/detail/{id}', [CrewingController::class, 'data_crew_detail'])->name('data_crew.detail');
    Route::get('crewing/data_crew/download/{id}', [CrewingController::class, 'data_crew_detail_download'])->name('data_crew.download');

    Route::get('crewing/message', [CrewingController::class, 'message'])->name('message');
    Route::post('crewing/message', [CrewingController::class, 'messageStore'])->name('message.store');
    Route::post('crewing/broadcast', [CrewingController::class, 'messageBroadcast'])->name('message.broadcast');
    Route::get('crewing/profile', [CrewingController::class, 'profile'])->name('crewing.profile');
    Route::post('crewing/profile', [CrewingController::class, 'updateProfile'])->name('crewing.update.profile');
    
    Route::resource('lowongan', LowonganKerja::class);
    Route::get('lamaran', [DataLamaranController::class, 'index'])->name('lamaran.index');
    Route::post('lamaran/update_status_lamaran/{id}', [DataLamaranController::class, 'update_status'])->name('lamaran.update_status');
    Route::resource('crew', CrewController::class);
    Route::resource('crewing', CrewingController::class);
    Route::resource('ship', ShipController::class);
    Route::resource('crew_list', CrewListController::class);
    Route::resource('signonoff', SignOnOffController::class);
    Route::resource('crew_rotation', CrewRotationController::class);
});