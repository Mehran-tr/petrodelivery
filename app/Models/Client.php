<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    protected $fillable = ['name', 'address', 'phone', 'company_id'];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
