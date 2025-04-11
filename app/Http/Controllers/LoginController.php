<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function signup() {
        return view('auth.signup');
    }

    
    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            }else if ($user->role === 'tim') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            }else if ($user->role === 'kaprodi') {
                return redirect()->route('admin.dashboard')->with('succes', 'Login Berhasil');
            }else if ($user->role === 'wadir1'){
                return redirect()->route('wadir1.dashboard')->with('succes', 'Login Berhasil');
            }
        }


        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function showForgotPasswordForm() {
        return view('auth.forgot-password');
    }
    

    public function forgotPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem'
        ]);

        $token = Str::random(60);

        PasswordResetToken::updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );        
        Log::info('Menyimpan reset password', [
            'email' => $request->email,
            'token' => $token
        ]);
        

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success', 'Email reset password telah dikirim.');
    }   

    public function validasi_forgotPassword($token) {
        $passwordReset = PasswordResetToken::where('token', $token)->first();
    
        if (!$passwordReset) {
            return redirect()->route('forgot-password')->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa']);
        }
    
        return view('auth.validasi-forgot-password', ['token' => $token]);
    }    

    public function showResetPasswordForm($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request) {    
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    
        $passwordReset = PasswordResetToken::where('token', $request->token)->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah kadaluarsa']);
        }
                
        if (!isset($passwordReset->email) || empty($passwordReset->email)) {
            Log::error('Email tidak ditemukan di token reset:', ['passwordReset' => $passwordReset]);
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem']);
        }
        
        $user = User::where('email', $passwordReset->email)->first();
        
        if (!$user) {
            Log::error('User dengan email ini tidak ditemukan:', ['email' => $passwordReset->email]);
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem']);
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        $passwordReset->delete();
        
        return redirect()->route('login')->with('success', 'Password berhasil direset, silakan login.');        
    }    

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }
}