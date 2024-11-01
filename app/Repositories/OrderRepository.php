<?php

namespace App\Repositories;

use App\Models\Order;

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

    public function create(array $data) {
        return Order::create($data);
    }

    public function update($id, array $data) {
        $order = $this->findById($id);
        $order->update($data);
        return $order;
    }

    public function delete($id) {
        $order = $this->findById($id);
        return $order->delete();
    }
}
