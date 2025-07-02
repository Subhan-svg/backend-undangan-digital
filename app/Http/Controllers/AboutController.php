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
        $about = About::count();
        return view('about.index', compact('about'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'required' => ':attribute harus di isi!',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->image <> '') {
        $image = $request->file('image');
        $nameimage = 'Image-'.str_replace(' ','-', $request->get('title')).'-'.Str::random(4).'.'.$image->extension();
        $tujuan = 'images/about/';
        $image->move(public_path($tujuan), $nameimage);
        $imagename = $tujuan.''.$nameimage;
        }

        $about = new About();
        $about->title = $request->title;
        $about->slug = strtolower(str_replace(' ', '-', $request->title));
        $about->description = $request->description;
        $about->image = $imagename;
        $about->save();

        return redirect()->route('about')->with('toast_success', 'About Berhasil Di Tambahkan');
    }

    public function edit($slug)
    {
        $about = About::where('slug', $slug)->first();
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, $slug)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }
        
        if ($request->hasFile('image')) {
            $oldimage = About::get('image');
            if ($oldimage && file_exists(public_path($oldimage))) {
                unlink(public_path($oldimage));
            }

            $image = $request->file('image');
            $nameimage = 'Image-'.str_replace(' ','-', $request->get('title')).'-'.Str::random(4).'.'.$image->extension();
            $tujuan = 'images/about/';
            $image->move(public_path($tujuan), $nameimage);
            $imagename = $tujuan.''.$nameimage;
        }  
           


        $about = About::where('slug', $slug)->first();
        $about->title = $request->title;
        $about->slug = strtolower(str_replace(' ', '-', $request->title));
        $about->description = $request->description;
        if ($request->image <> '') {
            $about->image = $imagename;
        }
        $about->save();

        return redirect()->route('about')->with('toast_success', 'About Berhasil di Update');
    }

    public function destroy($id){
        $about = About::find($id);
        $about->delete();
        
        return redirect()->route('about')->with('toast_success', 'About Berhasil di Hapus');
    }
}
