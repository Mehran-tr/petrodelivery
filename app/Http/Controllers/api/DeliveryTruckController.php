<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryTruckRequest;
use App\Repositories\DeliveryTruckRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryTruckController extends Controller {
    protected $truckRepository;

    public function __construct(DeliveryTruckRepositoryInterface $truckRepository) {
        $this->truckRepository = $truckRepository;
    }

    public function index(): JsonResponse {
        $trucks = $this->truckRepository->all();
        return response()->json($trucks);
    }

    public function store(DeliveryTruckRequest $request): JsonResponse {
        $truck = $this->truckRepository->create($request->validated());
        return response()->json($truck, 201);
    }

    public function show($id): JsonResponse {
        $truck = $this->truckRepository->findById($id);
        return response()->json($truck);
    }

    public function update(DeliveryTruckRequest $request, $id): JsonResponse {
        $truck = $this->truckRepository->update($id, $request->validated());
        return response()->json($truck);
    }

    public function destroy($id): JsonResponse {
        $this->truckRepository->delete($id);
        return response()->json(null, 204);
    }
}
