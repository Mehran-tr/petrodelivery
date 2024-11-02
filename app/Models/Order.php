<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model {
    use HasFactory;
    protected $fillable = ['client_id','location_id', 'company_id','user_id', 'fuel_amount', 'delivery_address', 'status'];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }
}
