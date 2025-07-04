<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::all();
            
            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Categories Not Found',
                    'data' => []
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get Categories Success',
                'data' => CategoryResource::collection($categories)
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
            $category = Category::where('slug', $slug)->first();
            
            if (!$category) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Category Not Found',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get Category Success',
                'data' => new CategoryResource($category)
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
