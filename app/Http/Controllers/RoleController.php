<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('role-list')) {
            abort(403, 'Access Denied');
        }
        return view('role.index');
    }

    public function listData()
    {
        $data = Role::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                if (auth()->user()->can('role-edit')) {
                    $btn = '<a href="'.route('role.edit', $row->id).'" class="btn btn-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i></a>';
                }
                if (auth()->user()->can('role-delete')) {
                    $btn .= '<form id="delete-role-'.$row->id.'" action="'.route('role.destroy', $row->id).'" method="POST" style="display:inline;">'
                        .csrf_field()
                        .method_field('DELETE')
                        .'<button type="button" class="btn btn-danger btn-sm mb-2" onclick="confirmDelete(\'delete-role-'.$row->id.'\')"><i class="fas fa-trash"></i></button>'
                        .'</form>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        if (!auth()->user()->can('role-create')) {
            abort(403, 'Access Denied');
        }
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('role-create')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
            'permissions' => 'array',
        ]);
        $role = Role::create($request->only('name', 'guard_name'));
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('role')->with('success', 'Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('role-edit')) {
            abort(403, 'Access Denied');
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('role-edit')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'name' => 'required|unique:roles,name,'.$id,
            'guard_name' => 'required',
            'permissions' => 'array',
        ]);
        $role = Role::findOrFail($id);
        $role->update($request->only('name', 'guard_name'));
        $role->syncPermissions($request->permissions ?? []);
        // Sinkronisasi permission user yang punya role ini
        $users = User::role($role->name)->get();
        foreach ($users as $user) {
            $user->syncPermissions($role->permissions->pluck('name')->toArray());
        }
        return redirect()->route('role')->with('success', 'Role berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('role-delete')) {
            abort(403, 'Access Denied');
        }
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role berhasil dihapus');
    }
} 