<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('permission-list')) {
            abort(403, 'Access Denied');
        }
        return view('permission.index');
    }

    public function listData()
    {
        $data = Permission::query();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                if (auth()->user()->can('permission-edit')) {
                    $btn = '<a href="'.route('permission.edit', $row->id).'" class="btn btn-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i></a>';
                }
                if (auth()->user()->can('permission-delete')) {
                    $btn .= '<form id="delete-permission-'.$row->id.'" action="'.route('permission.destroy', $row->id).'" method="POST" style="display:inline;">'
                        .csrf_field()
                        .method_field('DELETE')
                        .'<button type="button" class="btn btn-danger btn-sm mb-2" onclick="confirmDelete(\'delete-permission-'.$row->id.'\')"><i class="fas fa-trash"></i></button>'
                        .'</form>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        if (!auth()->user()->can('permission-create')) {
            abort(403, 'Access Denied');
        }
        return view('permission.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('permission-create')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required',
        ]);
        Permission::create($request->only('name', 'guard_name'));
        return redirect()->route('permission')->with('success', 'Permission berhasil ditambahkan');
    }

    public function edit($id)
    {
        if (!auth()->user()->can('permission-edit')) {
            abort(403, 'Access Denied');
        }
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('permission-edit')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id,
            'guard_name' => 'required',
        ]);
        $permission = Permission::findOrFail($id);
        $permission->update($request->only('name', 'guard_name'));
        return redirect()->route('permission')->with('success', 'Permission berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('permission-delete')) {
            abort(403, 'Access Denied');
        }
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->back()->with('success', 'Permission berhasil dihapus');
    }
} 