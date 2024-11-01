<?php

// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
class Company extends Model {
    use UsesTenantConnection;

    protected $fillable = ['name', 'domain'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function deliveryTrucks() {
        return $this->hasMany(DeliveryTruck::class);
    }
}

