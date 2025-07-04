<?php

namespace App\Http\Controllers;

use App\Models\About;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('about-list')) {
            abort(403, 'Access Denied');
        }
        $aboutcount = About::count();
        $about = About::first();
        return view('about.index', compact('aboutcount', 'about'));
    }

    public function listData()
    {
        $data = About::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function($row){
                $image = '';
                if($row->image <> ''){
                    $image = '<img src="'.url($row->image).'" width="80">';
                }
                return $image;
            })
            ->addColumn('action', function ($row) {
                $btn =
                    '<a href ="' .
                    route('about.edit', $row->slug) .
                    '" class="btn btn-primary btn-sm mr-2 mb-2">
                            <i class="fas fa-edit"></i>
                        </a>';
                
                return $btn;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);

        return $datatables;
    }

    public function create()
    {
        return view('about.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->can('about-create')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $about = new About();
        $about->title = $request->title;
        $about->slug = $this->generateUniqueSlug($request->title);
        $about->description = $request->description;

        if ($request->image <> '') {
            $image = $request->file('image');
            $nameimage = 'Image-'.str_replace(' ','-', $request->get('title')).'-'.Str::random(4).'.'.$image->extension();
            $tujuan = 'images/about/';
            $image->move(public_path($tujuan), $nameimage);
            $imagename = $tujuan.''.$nameimage;

            $about->image = $imagename;
        }

        $about->save();

        return redirect()->route('about')->with('success', 'About Successfully Added');
    }

    public function edit($slug)
    {
        $about = About::where('slug', $slug)->first();
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, $slug)
    {
        if (!auth()->user()->can('about-edit')) {
            abort(403, 'Access Denied');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $about = About::where('slug', $slug)->first();
        $about->title = $request->title;
        $about->slug = $this->generateUniqueSlug($request->title, $about->id);
        $about->description = $request->description;

        if ($request->hasFile('image')) {
            $oldimage = $about->image;
            if ($oldimage && file_exists(public_path($oldimage))) {
                unlink(public_path($oldimage));
            }

            $image = $request->file('image');
            $nameimage = 'Image-'.str_replace(' ','-', $request->get('title')).'-'.Str::random(4).'.'.$image->extension();
            $tujuan = 'images/about/';
            $image->move(public_path($tujuan), $nameimage);
            $imagename = $tujuan.''.$nameimage;

            $about->image = $imagename;
        }
        
        $about->save();

        return redirect()->route('about')->with('success', 'About Successfully Updated');
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('about-delete')) {
            abort(403, 'Access Denied');
        }
        $about = About::find($id);
        $about->delete();
        
        return redirect()->route('about')->with('success', 'About Successfully Deleted');
    }

    // Helper untuk generate slug unik
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $originalSlug = $slug;
        $i = 1;
        while (About::where('slug', $slug)
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
