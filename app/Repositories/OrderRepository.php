<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\OrderRequest;

class OrderRepository implements OrderRepositoryInterface {

    public function all() {
        return Order::all();
    }

    public function findById($id) {
        return Order::findOrFail($id);
    }

    public function findByClientId($clientId) {
        return Order::where('client_id', $clientId)->get();
    }

    /**
     * Store a new order in the database.
     */
    public function create(array $data): JsonResponse {
        $order = Order::create([
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'client_id' => $data['client_id'],
            'location_id' => $data['location_id'],
            'fuel_amount' => $data['fuel_amount'],
            'delivery_address' => $data['delivery_address'],
            'status' => $data['status'] ?? 'pending',
        ]);

        return response()->json($order, 201);
    }

    /**
     * Update an existing order in the database.
     */
    public function update($id, array $data): JsonResponse {
        $order = $this->findById($id);

        // Only update specific fields, excluding user_id
        $order->update([
            'client_id' => $data['client_id'],
            'fuel_amount' => $data['fuel_amount'],
            'delivery_address' => $data['delivery_address'],
            'status' => $data['status'] ?? $order->status,
        ]);

        return response()->json($order);
    }

    public function delete($id) {
        $order = $this->findById($id);
        return $order->delete();
    }
}
