<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\crew;
use App\Models\rank;
use App\Models\User;
use App\Models\crewing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Termwind\Components\Raw;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use App\Mail\PasswordResetLinkMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            return back()->with('status', 'Login failed, Check your email and password!');
        }

        if(Auth::user()->role == 'crew') {
            return redirect('/')->with('success', 'Login Success');
        }else if(Auth::user()->role == 'crewing') {
            return redirect('/crewing')->with('success', 'Login Success');
        } else {
            return redirect()->back()->with('status', 'Login failed, Check your email and password!');
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

            $path = $_SERVER['DOCUMENT_ROOT'] . 'image/id_card';
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
            $path = $_SERVER['DOCUMENT_ROOT'] .'/userdata/avatar/';
            $image->move($path, $filename);
            $user['image'] = $filename;
        }
        if($request->hasFile('ktp')) {
            $ktp = $request->file('ktp');
            $filename = $ktp->getClientOriginalName() . '.' . $ktp->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] .'/userdata/ktp/';
            $ktp->move($path, $filename);
            $crew['ktp'] = $filename;
        }
        if($request->hasFile('cv')) {
            $cv = $request->file('cv');
            $filename = $cv->getClientOriginalName() . '.' . $cv->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/cv/';
            $cv->move($path, $filename);
            $crew['curriculum_vitae'] = $filename;
        }
        if($request->hasFile('coc')) {
            $coc = $request->file('coc');
            $filename = $coc->getClientOriginalName() . '.' . $coc->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/coc/';
            $coc->move($path, $filename);
            $crew['certificate_of_competency'] = $filename;
        }
        if($request->hasFile('cop')) {
            $cop = $request->file('cop');
            $filename = $cop->getClientOriginalName() . '.' . $cop->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] .'/userdata/cop/';
            $cop->move($path, $filename);
            $crew['certificate_of_proficiency'] = $filename;
        }
        if($request->hasFile('smc')) {
            $smc = $request->file('smc');
            $filename = $smc->getClientOriginalName() . '.' . $smc->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/smc/';
            $smc->move($path, $filename);
            $crew['seaferer_medical_certificate'] = $filename;
        }
        if($request->hasFile('additional_document')) {
            $additional_document = $request->file('additional_document');
            $filename = $additional_document->getClientOriginalName() . '.' . $additional_document->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/additional_document/';
            $additional_document->move($path, $filename);
            $crew['additional_documents'] = $filename;
        }
        if($request->hasFile('seamans_book')) {
            $seamans_book = $request->file('seamans_book');
            $filename = $seamans_book->getClientOriginalName() . '.' . $seamans_book->getClientOriginalExtension();
            $path = $_SERVER['DOCUMENT_ROOT'] . '/userdata/seamans_book/';
            $seamans_book->move($path, $filename);
            $crew['seamans_book'] = $filename;
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

    public function changePassword() {
        return view('auth.change-password', ['active' => 'change-password']);
    }

    public function changePasswordStore(Request $request) {
        $user = $request->user();
        
        // --- 2. Memverifikasi Password Lama ---
        if (! Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with([
                'error' => 'The old password you entered is incorrect.',
            ]);
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with([
                'error' => 'The new password cannot be the same as the old password.',
            ]);
        }
        
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // --- 5. Respons Berhasil ---
        if(Auth::user()->role == 'crewing') {
            return redirect('/crewing')->with('success', 'Password has been update!');
        }else {
            return redirect()->back()->with('success', 'Password has been update!');
        }
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }
    // public function forgotPasswordStore(Request $request)
    // {
    //     $currentMailer = config('mail.mailer');
    //     Log::info("Mailer yang sedang aktif: " . $currentMailer);
    //     // 1. Validasi Email
    //     $request->validate(['email' => 'required|email']);
        
    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         // Mengembalikan pesan sukses palsu untuk keamanan
    //         return redirect()->back()->with('success', 'Kami telah mengirimkan tautan reset password ke email Anda jika akun tersebut terdaftar.');
    //     }

    //     // 2. Hapus token lama & Buat Token Baru
    //     // Laravel menyimpan token di tabel `password_reset_tokens`
    //     $token = Str::random(60); 

    //     DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    //     DB::table('password_reset_tokens')->insert([
    //         'email' => $user->email,
    //         'token' => Hash::make($token), // Simpan token yang di-hash
    //         'created_at' => now()
    //     ]);

    //     // 3. Buat URL Reset
    //     // Token yang dikirim ke user adalah token PLAIN TEXT ($token)
    //     $resetUrl = route('reset_password', [
    //         'token' => $token, // Plain token untuk URL
    //         'email' => $user->email,
    //     ]);
        
    //     Log::info("Siap kirim email."); // Cek apakah baris ini masuk log
    //     // 4. Kirim Email
    //     try {
    //         Mail::to($user->email)->send(new PasswordResetLinkMail($resetUrl, $user->name));
    //         return redirect()->back()->with('success', 'Kami telah mengirimkan tautan reset password ke email Anda.');
    //     } catch (\Exception $e) {
    //         Log::error('Gagal mengirim email reset password: ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
    //         // Log error atau kembalikan error spesifik jika pengiriman email gagal
    //         return redirect()->back()->with(['error' => 'Gagal mengirim email. Silakan coba lagi.'])->withInput();
    //     }
    // }

    public function forgotPasswordStore(Request $request)
    {
        // ... (Logika token dan user lookup Anda tetap dipertahankan)

        // 1. Validasi Email
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('success', 'We have sent a password reset link to your email if the account is registered.');
        }

        // 2. Hapus token lama & Buat Token Baru
        $token = Str::random(60); 

        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token), // Simpan token yang di-hash
            'created_at' => now()
        ]);

        // 3. Buat URL Reset
        $resetUrl = route('reset_password', [
            'token' => $token, 
            'email' => $user->email,
        ]);
        
        try {
            $viewData = [
                'name'        => $user->name, 
                'resetLink'   => $resetUrl, 
                'expiryHours' => config('auth.passwords.users.expire') / 60, 
            ];
            $htmlBody = view('emails.password-reset', $viewData)->render();
            $emailSubject = 'Request to Reset Your Password'; // Hardcode atau ambil dari Mailable Anda
            
        } catch (\Exception $e) {
            Log::error('Gagal merender Blade View: ' . $e->getMessage());
            return redirect()->back()->with(['error' => 'Failed to create email template.']);
        }
        
        // ==========================================================
        // **LOGIKA PENGIRIMAN PHPMailer DENGAN KONTEN BLADE**
        // ==========================================================
        try {
            $mail = new PHPMailer(true);

            // Server settings (Menggunakan nilai yang berhasil Anda dapatkan dari env)
            $mail->SMTPDebug = 0; // Ubah ke 0 (Off) atau 2 (Debug)
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL (Sesuai 465)
            $mail->Port       = env('MAIL_PORT'); // 465

            // Recipients
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'SIRAKA WGM');
            $mail->addAddress($user->email, $user->name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $emailSubject; // Ambil Subject dari Mailable
            $mail->Body    = $htmlBody; // Gunakan konten HTML yang dirender dari Blade
            $mail->AltBody = strip_tags($htmlBody); // Plain text untuk klien email lama

            $mail->send();
            Log::info("Email reset password berhasil dikirim via PHPMailer ke: " . $user->email);

        } catch (\Exception $e) {
            $error_message = "PHPMailer ERROR: {$mail->ErrorInfo} | Exception: {$e->getMessage()}";
            Log::error($error_message);
            return redirect()->back()->with(['error' => 'Failed to send email: ' . $error_message]);
        }
        // ==========================================================

        return redirect()->back()->with('success', 'We have sent a password reset link to your email.');
    }
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

    public function resetPassword($token, Request $request)
    {
        // Pastikan parameter 'email' ada di query string URL
        $email = $request->query('email');

        if (!$email) {
            return redirect('/login')->with('error', 'Password reset link is invalid or incomplete.');
        }

        // 1. Cari token di database berdasarkan email
        $passwordReset = DB::table('password_reset_tokens')
                        ->where('email', $email)
                        ->first();

        // 2. Cek apakah token ditemukan
        if (!$passwordReset) {
            Log::warning("Reset token not found for email: {$email}");
            return redirect('/login')->with('error', 'Invalid password reset token.');
        }

        // 3. Verifikasi Token Hash
        // Cek apakah token dari URL cocok dengan token yang di-hash di database
        if (!Hash::check($token, $passwordReset->token)) {
            Log::warning("Token tidak cocok untuk email: {$email}");
            return redirect('/login')->with('error', 'The password reset token is invalid or has already been used.');
        }

        // 4. Cek Kedaluwarsa (Token Expired)
        
        // Ambil waktu kedaluwarsa dari config/auth.php (biasanya dalam menit)
        $expiryMinutes = config('auth.passwords.users.expire'); 
        
        // Hitung kapan token akan kedaluwarsa
        $createdAt = Carbon::parse($passwordReset->created_at);
        $expiresAt = $createdAt->addMinutes($expiryMinutes);
        
        // Cek apakah waktu saat ini melebihi waktu kedaluwarsa
        if (Carbon::now()->greaterThan($expiresAt)) {
            
            // Hapus token yang kedaluwarsa dari database
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            
            Log::warning("Reset token kedaluwarsa untuk email: {$email}");
            return redirect('/login')->with('error', 'The password reset link has expired. Please request a new link.');
        }

        // Jika semua verifikasi lolos:
        
        // Kirim token dan email ke view untuk ditampilkan di formulir
        return view('auth.reset-password-form', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    public function resetPasswordStore(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $token = $request->input('token');
            $email = $request->input('email');
            $password = $request->input('password');

            // 1. Cari token di database berdasarkan email
            $passwordReset = DB::table('password_reset_tokens')
                            ->where('email', $email)
                            ->first();

            // 2. Cek apakah token ditemukan
            if (!$passwordReset) {
                Log::warning("Reset token tidak ditemukan untuk email: {$email}");
                return redirect('/login')->with('error', 'Invalid password reset token.');
            }

            // 3. Verifikasi Token Hash
            // Cek apakah token dari URL cocok dengan token yang di-hash di database
            if (!Hash::check($token, $passwordReset->token)) {
                Log::warning("Token tidak cocok untuk email: {$email}");
                return redirect('/login')->with('error', 'The password reset token is invalid or has already been used.');
            }

            // 4. Cek Kedaluwarsa (Token Expired)
            
            // Ambil waktu kedaluwarsa dari config/auth.php (biasanya dalam menit)
            $expiryMinutes = config('auth.passwords.users.expire'); 
            
            // Hitung kapan token akan kedaluwarsa
            $createdAt = Carbon::parse($passwordReset->created_at);
            $expiresAt = $createdAt->addMinutes($expiryMinutes);
            
            // Cek apakah waktu saat ini melebihi waktu kedaluwarsa
            if (Carbon::now()->greaterThan($expiresAt)) {
                
                // Hapus token yang kedaluwarsa dari database
                DB::table('password_reset_tokens')->where('email', $email)->delete();
                
                Log::warning("Reset token kedaluwarsa untuk email: {$email}");
                return redirect('/login')->with('error', 'The password reset link has expired. Please request a new link.');
            }

            // Jika semua verifikasi lolos:

            // Update password
            $user = User::where('email', $email)->first();
            $user->password = Hash::make($password);
            $user->save();

            // Hapus token dari database
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            Log::info("Password berhasil direset untuk email: {$email}");
            return redirect('/login')->with('status', 'Password has been reset!');
        } catch (\Exception $e) {
            Log::error("Gagal reset password. Error: {$e->getMessage()}");
            return redirect('/login')->with('status', 'Failed to reset password, please try again!');
        }
    }
}