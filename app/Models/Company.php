<?php

// app/Models/Company.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Company extends Model {
    use HasFactory;

    protected $fillable = ['name', 'domain'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function trucks() {
        return $this->hasMany(DeliveryTruck::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}

