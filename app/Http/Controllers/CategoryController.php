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
        return view('category.index');
    }

    public function listData()
    {
        $data = Category::query();
        $datatables = DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href ="'.route('category.edit', $row->slug).'" class="btn btn-primary btn-sm mr-2">
                        <i class="fas fa-edit"></i>
                    </a>';
             $btn .= '<a href ="'.route('category.destroy', $row->slug).'" class="btn btn-danger btn-sm mr-2">
                        <i class="fas fa-trash"></i>
                    </a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        
        return $datatables;
    }

    public function create()
    {
        $category = Category::get();
        return view('category.create', compact('category'));
    }
    
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), 
        [
            'title' => 'required'
        ]);

        if($validate->fails()) 
        {
            return back()->withErrors($validate)->withInput();
        }

        $category = new Category();
        $category->title = $request->title;
        $category->slug = strtolower(str_replace(' ', '-', $request->title));
        $category->save();

        return redirect()->route('category')->with('success', 'Category berhasil ditambahkan');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('category.edit', compact('category'));
    }
    
    public function update(Request $request,  $slug)
    {
         $validate = Validator::make($request->all(), 
        [
            'title' => 'required'
        ]);

        if($validate->fails()) 
        {
            return back()->withErrors($validate)->withInput();
        }

        $category = Category::where('slug',$slug)->first();
        $category->title = $request->title;
        $category->slug = strtolower(str_replace(' ', '-', $request->title));
        $category->save();

        return redirect()->route('category')->with('success', 'Category berhasil diperbarui');
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();

        return redirect()->back()->with('success', 'Category berhasil dihapus');
    }
}
