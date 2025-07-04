<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index() 
    {
        if (!auth()->user()->can('category-list')) {
            abort(403, 'Access Denied');
        }

        return view('category.index');
    }

    public function listData()
    {
        $data = Category::query();
        $datatables = DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '';

            if (auth()->user()->can('category-edit')) {
                $btn = '<a href ="'.route('category.edit', $row->slug).'" class="btn btn-primary btn-sm me-2 mb-2">
                            <i class="fas fa-edit"></i>
                        </a>';
            }
            if (auth()->user()->can('category-delete')) {
                $btn .= '<form id="delete-category-'.$row->id.'" action="'.route('category.destroy', $row->slug).'" method="POST" style="display:inline;">'
                        .csrf_field()
                        .method_field('DELETE')
                        .'<button type="button" class="btn btn-danger btn-sm mb-2" onclick="confirmDelete(\'delete-category-'.$row->id.'\')">
                            <i class="fas fa-trash"></i>
                        </button>'
                    .'</form>';
            }

            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        
        return $datatables;
    }

    public function create()
    {
        if (!auth()->user()->can('category-create')) {
            abort(403, 'Access Denied');
        }
        return view('category.create');
    }
    
    public function store(Request $request)
    {
        if (!auth()->user()->can('category-create')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'title' => 'required',
        ]);

        $category = new Category();
        $category->title = $request->title;
        $category->slug = $this->generateUniqueSlug($request->title);
        $category->save();

        return redirect()->route('category')->with('success', 'Category Successfully Added');
    }

    public function edit($slug)
    {
        if (!auth()->user()->can('category-edit')) {
            abort(403, 'Access Denied');
        }
        $category = Category::where('slug', $slug)->first();
        return view('category.edit', compact('category'));
    }
    
    public function update(Request $request,  $slug)
    {
        if (!auth()->user()->can('category-edit')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'title' => 'required',
        ]);

        $category = Category::where('slug',$slug)->first();
        $category->title = $request->title;
        $category->slug = $this->generateUniqueSlug($request->title, $category->id);
        $category->save();

        return redirect()->route('category')->with('success', 'Category Successfully Updated');
    }

    public function destroy($slug)
    {
        if (!auth()->user()->can('category-delete')) {
            abort(403, 'Access Denied');
        }

        $category = Category::where('slug', $slug)->first();
        $category->delete();

        return redirect()->back()->with('success', 'Category Successfully Deleted');
    }

    // Helper untuk generate slug unik
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $originalSlug = $slug;
        $i = 1;
        while (Category::where('slug', $slug)
            ->when($ignoreId, function($query) use ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }
}
