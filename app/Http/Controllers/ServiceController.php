<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('service.index');
    }

    public function listData()
    {
        $data = Service::query();
        $datatables = DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('image', function($row){
            $image = '';
            if($row->image <> ''){
                $image = '<img src="'.url($row->image).'" width="80">';
            }
            return $image;
        })
        ->addColumn('action', function($row){
            $btn = '<a href ="'.route('service.edit', $row->slug).'" class="btn btn-primary btn-sm mr-2 mb-2">
                        <i class="fas fa-edit"></i>
                    </a>';
            $btn .= '<a href="'.route('service.destroy', $row->slug).'" class="btn btn-danger btn-sm mr-2 mb-2">
                        <i class="fas fa-trash"></i>
                    </a>';

            return $btn;
        })
        ->rawColumns(['action', 'image'])
        ->make(true);

        return $datatables;
    }

    public function create()
    {
        $services = Service::get();
        return view('service.create', compact('services'));
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        if($request->image <> ''){
            $image = $request->file('image');
            $nameImage = 'Image-'.Str::random(5).'-'.$image->extension();
            $image->move(public_path('images/services'), $nameImage);
            $imageName = 'images/services/'.$nameImage;
        }

        $services = new Service();
        $services->title = $request->title;
        $services->slug = strtolower(str_replace(' ', '-', $request->title));
        $services->description = $request->description;
        $services->image = $imageName;
        $services->save();

        return redirect()->route('service')->with('success', 'Service berhasil ditambahkan');
    }

    public function edit($slug)
    {
        $services = Service::where('slug', $slug)->first();
        return view('service.edit', compact('services'));
    }

    public function update(Request $request, $slug)
    {
        $validate = Validator::make($request->all(), 
        [
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        if ($request->hasFile('image')){
            $oldImage = Service::get('image');
            if($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $image = $request->file('image');
            $nameImage = 'Image-'.Str::random(5).'-'.$image->extension();
            $image->move(public_path('images/services/'), $nameImage);
            $imageName = 'images/services/'.$nameImage;
        }

        $services = Service::where('slug', $slug)->first();
        $services->title = $request->title;
        $services->slug = strtolower(str_replace(' ', '-', $request->title));
        $services->description = $request->description;
        $services->image = $imageName;
        $services->save();

        return redirect()->route('service')->with('success', 'Service berhasil diperbarui');
    }

    public function destroy($slug)
    {
        $services = Service::where('slug', $slug)->first();
        $services->delete();

        return redirect()->back()->with('success', 'Service berhasil dihapus');
    }
}
