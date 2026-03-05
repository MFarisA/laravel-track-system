<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'password'     => 'required|min:8|confirmed',
            'role'         => 'required|string|in:admin,driver',

            'employee_id'    => 'required_if:role,driver|string|unique:drivers',
            'license_number' => 'required_if:role,driver|string',
            'license_expiry' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'         => $request->name,
                'email'        => $request->email,
                'phone_number' => $request->phone_number,
                'password'     => Hash::make($request->password),
            ]);

            // Assign role via Spatie
            $user->assignRole($request->role);

            // Jika driver, buat record di tabel drivers
            if ($request->role === 'driver') {
                Driver::create([
                    'user_id'        => $user->id,
                    'employee_id'    => $request->employee_id,
                    'license_number' => $request->license_number,
                    'license_expiry' => $request->license_expiry,
                ]);
            }
        });

        return redirect()->back()->with('success', 'User berhasil dibuat.');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors(['email' => 'email or password is incorrect'])->withInput();
        }
        $user = Auth::user();
        if (!$user->hasRole(['admin', 'super_admin'])) {
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'you dont have access to admin dashboard'])->withInput();
        }
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'logout success');
    }
}
