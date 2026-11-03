<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required'], // Bisa email atau username
            'password' => ['required'],
        ]);

        $fieldType = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $credentials['login'], 'password' => $credentials['password']], $request->remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $role = Auth::user()->role;
            if ($role === 'admin') return redirect()->route('admin.dashboard');
            if ($role === 'karyawan') return redirect()->route('karyawan.dashboard');
            return redirect()->route('siswa.dashboard');
        }

        throw ValidationException::withMessages([
            'login' => __('Kredensial yang diberikan tidak cocok dengan data kami.'),
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi dasar
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:siswa,karyawan'], // Admin biasanya dibuat seed/manual
            'nama_lengkap' => ['required', 'string', 'max:255'],

            // Validasi kondisional berdasarkan role diurus via frontend/backend rules
            'nisn'     => ['required_if:role,siswa', 'nullable', 'string', 'unique:siswa'],
            'kelas'    => ['required_if:role,siswa', 'nullable', 'string'],
            'nip'      => ['required_if:role,karyawan', 'nullable', 'string', 'unique:karyawan'],
            'jabatan'  => ['required_if:role,karyawan', 'nullable', 'string'],
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat User Master
            $user = User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            // 2. Buat relasi profil spesifik
            if ($request->role === 'siswa') {
                Siswa::create([
                    'user_id'      => $user->id,
                    'nisn'         => $request->nisn,
                    'nama_lengkap' => $request->nama_lengkap,
                    'kelas'        => $request->kelas,
                    'no_hp'        => $request->no_hp,
                ]);
            } else if ($request->role === 'karyawan') {
                Karyawan::create([
                    'user_id'      => $user->id,
                    'nip'          => $request->nip,
                    'nama_lengkap' => $request->nama_lengkap,
                    'jabatan'      => $request->jabatan,
                    'no_hp'        => $request->no_hp,
                ]);
            }

            DB::commit();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route($request->role . '.dashboard');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
