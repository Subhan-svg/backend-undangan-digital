<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AboutResource;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
         try {
            $abouts = about::all();
            
            if ($abouts->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'about Not Found',
                    'data' => []
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get about Success',
                'data' => AboutResource::collection($abouts)
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($slug)
    {
        try {
            $about = About::where('slug', $slug)->first();
            
            if (!$about) {
                return response()->json([
                    'status' => 404,
                    'message' => 'About Not Found',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get About Success',
                'data' => new AboutResource($about)
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
