<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public const ROLE_ADMIN = 'admin';
    public const ROLE_OPERATOR = 'operator';
    public const ROLE_USER = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'company_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];




    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Define role-based helper methods
    public function isAdmin() {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isOperator() {
        return $this->role === self::ROLE_OPERATOR;
    }

    public function isUser() {
        return $this->role === self::ROLE_USER;
    }

    public function refreshTokens()
    {
        return $this->hasMany(RefreshToken::class);
    }
}
