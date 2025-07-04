<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    
    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->with('error', $validator->errors()->all());
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }

    public function profile()
    {
        $user = auth()->user();
        $roles = Role::all();
        $permissions = Permission::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        $userPermissions = $user->permissions->pluck('name')->toArray();
        return view('profile.index', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->update($request->only(['name', 'email']));
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }
        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->with('error', $validator->errors()->all());
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
