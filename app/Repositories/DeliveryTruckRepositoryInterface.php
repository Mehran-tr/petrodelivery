<?php
namespace App\Repositories;

interface DeliveryTruckRepositoryInterface extends RepositoryInterface {
    public function findByLicensePlate($licensePlate);
}
