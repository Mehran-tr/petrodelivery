<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTruck extends Model {
    protected $fillable = ['company_id', 'license_plate', 'model', 'driver_name'];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
