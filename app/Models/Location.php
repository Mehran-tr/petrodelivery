<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model {
    use HasFactory;

    protected $fillable = [
        'client_id', 'address_line1', 'address_line2', 'city', 'state', 'zip_code', 'country'
    ];

    // Relationship: Each location belongs to a client
    public function client() {
        return $this->belongsTo(Client::class);
    }

    // Relationship: Each location can have multiple orders delivered to it
    public function orders() {
        return $this->hasMany(Order::class);
    }
}
