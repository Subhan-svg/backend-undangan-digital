<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
         try {
            $services = Service::all();
            
            if ($services->isEmpty()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Services Not Found',
                    'data' => []
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get Services Success',
                'data' => ServiceResource::collection($services)
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
            $service = Service::where('slug', $slug)->first();
            
            if (!$service) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Service Not Found',
                    'data' => null
                ], 404);
            }
            
            return response()->json([
                'status' => 200,
                'message' => 'Get Service Success',
                'data' => new ServiceResource($service)
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
