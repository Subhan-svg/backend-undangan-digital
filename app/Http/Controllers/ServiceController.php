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
            $image = '<span class="badge bg-danger">No Image</span>';
            if($row->image <> ''){
                $image = '<img src="'.url($row->image).'" width="80">';
            }
            return $image;
        })
        ->addColumn('action', function($row){
            $btn = '<a href ="'.route('service.edit', $row->slug).'" class="btn btn-primary btn-sm me-2 mb-2">
                        <i class="fas fa-edit"></i>
                    </a>';
            $btn .= '<form id="delete-service-'.$row->id.'" action="'.route('service.destroy', $row->slug).'" method="POST" style="display:inline;">'
                        .csrf_field()
                        .method_field('DELETE')
                        .'<button type="button" class="btn btn-danger btn-sm mb-2" onclick="confirmDelete(\'delete-service-'.$row->id.'\')">
                            <i class="fas fa-trash"></i>
                        </button>'
                    .'</form>';

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
        ]);

        $services = new Service();
        $services->title = $request->title;
        $services->slug = $this->generateUniqueSlug($request->title);
        $services->description = $request->description;

        if($request->image <> ''){
            $image = $request->file('image');
            $nameImage = 'Image-'.Str::random(5).'-Service.'.$image->extension();
            $image->move(public_path('images/services'), $nameImage);
            $imageName = 'images/services/'.$nameImage;

            $services->image = $imageName;
        }

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png,svg',
        ]);

        $services = Service::where('slug', $slug)->first();

        if ($request->hasFile('image')){
            $oldImage = $services->image;
            if($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }

            $image = $request->file('image');
            $nameImage = 'Image-'.Str::random(5).'-Service.'.$image->extension();
            $image->move(public_path('images/services/'), $nameImage);
            $imageName = 'images/services/'.$nameImage;

            $services->image = $imageName;
        }

        
        $services->title = $request->title;
        $services->slug = $this->generateUniqueSlug($request->title, $services->id);
        $services->description = $request->description;
        $services->save();

        return redirect()->route('service')->with('success', 'Service berhasil diperbarui');
    }

    public function destroy($slug)
    {
        $services = Service::where('slug', $slug)->first();
        $oldImage = $services->image;
        if($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }
        $services->delete();

        return redirect()->back()->with('success', 'Service berhasil dihapus');
    }

    // Helper untuk generate slug unik
    private function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $originalSlug = $slug;
        $i = 1;
        while (Service::where('slug', $slug)
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
