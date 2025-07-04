<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function listData()
    {
        $data = User::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('user.edit', $row->id).'" class="btn btn-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit(Request $request, $id)
    {
        if (!auth()->user()->can('role-edit')) {
            abort(403, 'Akses ditolak');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        $userPermissions = $user->permissions->pluck('name')->toArray();
        return view('user.edit', compact('user', 'roles', 'permissions', 'userRoles', 'userPermissions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email']));

        if (auth()->user()->can('role-edit')) {
            $user->syncRoles($request->roles ?? []);
            // Assign permission otomatis sesuai role
            $permissions = [];
            if (!empty($request->roles)) {
                $role = Role::where('name', $request->roles[0])->first();
                if ($role) {
                    $permissions = $role->permissions->pluck('name')->toArray();
                }
            }
            $user->syncPermissions($permissions);
        }
        
        return redirect()->route('user')->with('success', 'User updated successfully');
    }
} 