<?php
namespace App\Repositories;

use App\Models\DeliveryTruck;

class DeliveryTruckRepository implements DeliveryTruckRepositoryInterface {
    public function all() {
        return DeliveryTruck::all();
    }

    public function findById($id) {
        return DeliveryTruck::findOrFail($id);
    }

    public function findByLicensePlate($licensePlate) {
        return DeliveryTruck::where('license_plate', $licensePlate)->first();
    }

    public function create(array $data) {
        return DeliveryTruck::create($data);
    }

    public function update($id, array $data) {
        $truck = $this->findById($id);
        $truck->update($data);
        return $truck;
    }

    public function delete($id) {
        $truck = $this->findById($id);
        return $truck->delete();
    }
}
