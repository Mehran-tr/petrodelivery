<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'token', // Store the hashed token
    ];

    /**
     * The refresh token belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
