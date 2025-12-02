<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginPage()
    {
        return view('livewire.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return back()
                ->withErrors(['email' => 'Email atau password salah!'])
                ->withInput();
        }

        $request->session()->regenerate();

        return $this->redirectByRole(Auth::user()->role);
    }

    public function showRegisterPage()
    {
        return view('livewire.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'mahasiswa',
        ]);

            Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => null,
            'major' => null,
            'class' => null,
            'year' => null,
            'photo' => null,
        ]);

        Auth::login($user);

        return $this->redirectByRole($user->role);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'     => redirect('/admin'),
            'dosen'     => redirect('/dosen'),
            'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
            default     => redirect('/'),
        };
    }
}
