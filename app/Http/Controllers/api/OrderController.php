<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller {
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository) {

        $this->orderRepository = $orderRepository;
    }

    public function index() {
        $companyId = auth()->user()->company_id;
        $orders = Order::where('company_id', $companyId)->get();

        return response()->json($orders);
    }

    public function store(OrderRequest $request): JsonResponse {
        return $this->orderRepository->create($request->all());
    }

    public function update(Request $request, $id): JsonResponse {
        $order = Order::findOrFail($id);

        // This will return a 403 response if the user is unauthorized
        $this->authorize('update', $order);

        // Proceed to update if authorized
        return $this->orderRepository->update($id, $request->only(['client_id', 'fuel_amount', 'delivery_address', 'status']));
    }

    public function show($id): JsonResponse {
        $order = $this->orderRepository->findById($id);
        return response()->json($order);
    }



    public function destroy($id): JsonResponse {
        $this->orderRepository->delete($id);
        return response()->json(null, 204);
    }
}
