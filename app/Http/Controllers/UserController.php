<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('user-list')) {
            abort(403, 'Akses ditolak');
        }
        return view('user.index');
    }

    public function create()
    {
        if (!auth()->user()->can('user-create')) {
            abort(403, 'Akses ditolak');
        }
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('user-create')) {
            abort(403, 'Akses ditolak');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array|min:1'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign roles
        $user->syncRoles($request->roles);

        // Assign permissions based on roles
        $permissions = [];
        foreach ($request->roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $rolePermissions = $role->permissions->pluck('name')->toArray();
                $permissions = array_merge($permissions, $rolePermissions);
            }
        }
        $user->syncPermissions(array_unique($permissions));

        return redirect()->route('user')->with('success', 'User created successfully');
    }

    public function listData()
    {
        $data = User::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                if (Auth::user()->can('user-edit')) {
                    $btn = '<a href="'.route('user.edit', $row->id).'" class="btn btn-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i></a>';
                }
                if ($row->id != Auth::user()->id && Auth::user()->can('user-delete')) {
                    $btn .= '<form id="delete-user-'.$row->id.'" action="'.route('user.destroy', $row->id).'" method="POST" style="display:inline;">'
                            .csrf_field()
                            .method_field('DELETE')
                            .'<button type="button" class="btn btn-danger btn-sm mb-2" onclick="confirmDelete(\'delete-user-'.$row->id.'\')">
                                <i class="fas fa-trash"></i>
                            </button>'
                        .'</form>';
                }

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit(Request $request, $id)
    {
        if (!auth()->user()->can('user-edit')) {
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
        if (!auth()->user()->can('user-edit')) {
            abort(403, 'Akses ditolak');
        }

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

    public function destroy($id)
    {
        if (!auth()->user()->can('user-delete')) {
            abort(403, 'Akses ditolak');
        }

        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
} 