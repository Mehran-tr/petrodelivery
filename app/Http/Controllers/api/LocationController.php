<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(LocationRequest $request): JsonResponse {
        $location = Location::create($request->validated());

        return response()->json($location, 201);
    }
}
