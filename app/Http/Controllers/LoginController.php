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
                'email' => "Account is frozen: $freezeMessage",
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            return $this->handleAuthenticatedUser($request);
        }
    }

    return back()->withErrors([
        'email' => 'Email and Password invalid',
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
        return ''; // The freezing period has expired
    }

    $freezePeriod = $now->diff($freezeUntil);

    $formattedPeriod = $freezePeriod->y . ' years, ' . $freezePeriod->m . ' months, ' . $freezePeriod->d . ' days';

    if ($freezePeriod->y == 0 && $freezePeriod->m == 0 && $freezePeriod->d == 0) {
        $formattedPeriod = 'less than a day';
    } elseif ($freezePeriod->y == 0 && $freezePeriod->m == 0 && $freezePeriod->d == 1) {
        $formattedPeriod = '1 day';
    }

    return "Your account is frozen for $formattedPeriod.\nReason: {$user->pesan_freeze}";
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
