<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoginController extends Controller
{

    //[Login-Sign In] Halaman Sign In
    function log(){
        return view('login.sign-in');
    }

    //[Login-Sign Up] Halaman Register User
    function register(){
        return view('login.signup');
    }
    
    function registerUser(Request $req){
       User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => 'user',
       ]);
            return redirect('/login');
    }

//[Login-Verifikasi User] Verifikasi User Login
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'string', 'max:100', 'email'],
        'password' => ['required'],
    ]);

    $user = Auth::getProvider()->retrieveByCredentials($credentials);

    if ($user) {
        if ($this->isUserFreezed($user)) {
            $freezeMessage = $this->getFreezeMessage($user);
            // If the user is frozen, redirect back with a freeze message
            return back()->withErrors([
                'freezeMessage' => $freezeMessage,
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            return $this->handleAuthenticatedUser($request);
        } else {
            return back()->withErrors([
                'credentials' => 'Password dan username Anda salah',
            ])->onlyInput('email');
        }
    }

    return back()->withErrors([
        'credentials' => 'Password dan username Anda salah',
    ])->onlyInput('email');
}


/**
 * Handle actions for an authenticated user based on their role.
 *
 * @param \Illuminate\Http\Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
protected function handleAuthenticatedUser(Request $request)
{
    $user = Auth::user();

    if ($user->role == 'admin') {
        // Tandai bahwa popup telah ditampilkan
        $request->session()->put('popup_shown', true);
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    if ($user->role == 'user') {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    if ($user->role == 'penulis') {
        $request->session()->regenerate();
        return redirect()->intended('/homeP');
    }

    if ($user->role == 'superadmin') {
        $request->session()->regenerate();
        return redirect()->intended('/dashboardSA');
    }

    return back()->withErrors([
        'email' => 'Invalid user role',
    ])->onlyInput('email');
}

/**
 * Check if the user account is frozen.
 *
 * @param \App\Models\User $user
 * @return bool
 */
protected function isUserFreezed($user)
{
    return $user->freeze_until && now()->lessThanOrEqualTo(Carbon::parse($user->freeze_until));
}

/**
 * Get the freeze message based on the freezing period.
 *
 * @param \App\Models\User $user
 * @return string
 */
protected function getFreezeMessage($user)
{
    if (!$user->freeze_until) {
        return '';
    }

    $freezeUntil = Carbon::parse($user->freeze_until);
    $now = now();

    if ($freezeUntil->isPast()) {
        return ''; // Periode pembekuan sudah berakhir
    }

    $freezePeriod = $now->diff($freezeUntil);

    $formattedPeriod = '';

    if ($freezePeriod->y > 0) {
        $formattedPeriod .= $freezePeriod->y . ' tahun, ';
    }
    
    if ($freezePeriod->m > 0) {
        $formattedPeriod .= $freezePeriod->m . ' bulan, ';
    }
    
    if ($freezePeriod->d > 0) {
        $formattedPeriod .= $freezePeriod->d . ' hari';
    }
    
    // Menghapus koma dan spasi di akhir jika ada
    $formattedPeriod = rtrim($formattedPeriod, ', ');

    // Penyesuaian teks tanggal
    $dateText = '';
    if (empty($formattedPeriod)) {
        $dateText = 'kurang dari satu hari';
    } elseif ($freezePeriod->d == 1) {
        $dateText = '1 hari';
    } else {
        $dateText = $formattedPeriod;
    }

    // Pesan yang lebih menarik dan informatif
    $reason = $user->pesan_freeze ? "{$user->pesan_freeze}" : ""; // Menambahkan alasan jika tersedia
    return "<div style='background-color: #f8d7da; color: #721c24; border-color: #f5c6cb; border-radius: .25rem; padding: 1rem;'><h2 style='margin-bottom: 0;'>Akun Anda Dibekukan</h2><p style='margin-top: 0; margin-bottom: 1rem;'>Mohon Maaf, akun Anda sedang dibekukan.</p><p style='margin-bottom: 1rem;'>Sementara itu, akun Anda tidak dapat diakses selama <strong>$dateText</strong> karena alasan <strong>$reason</strong>.</p><p>Jangan ragu untuk menghubungi kami untuk informasi lebih lanjut.</p></div>";
}



    //[Login-Lupa Password] Halaman Lupa Password
    function lupaPassword(){
        return view('login.lupaPassword');
    }

    function kirimEmail(Request $request){

        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = str::random(40);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return view('login.cekEmail');
    }
}

    //[Login-Lupa Password] Halaman Lupa Password
    function cekEmail(){
        return view('login.cekEmail');
    }
// LoginController.php
function resetPassword($token){
    $user = User::where('remember_token', $token)->first();
    
    if (!empty($user)) {
        return view('login.resetPassword', [
            'title' => 'Konfirmasi Lupa Sandi',
            'token' => $token, // Fix the array structure
        ]);
    } else {
        abort(404);
    }
}

function updatePassword(Request $request) {
    $token = $request->input('token');
    $user = User::where('remember_token', $token)->first();

    if (!empty($user)) {
        if ($request->input('password') == $request->input('konfirmasiPassword')) {
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect()->route('login')->with('success', "Password berhasil direset.");
        } else {
            return redirect()->back()->with('error', "Password dan konfirmasi password tidak sesuai.");
        }
    } else {
        abort(404);
    }
}



    //[Login-Logout] Logout User
        function logout(){
            Auth::logout();
            return redirect('/');
        }
    }
