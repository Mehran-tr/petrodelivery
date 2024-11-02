<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Relationship: A client has multiple locations
    public function locations() {
        return $this->hasMany(Location::class);
    }
}
