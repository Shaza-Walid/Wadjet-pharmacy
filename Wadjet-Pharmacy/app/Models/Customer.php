<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens;

    protected $primaryKey = 'customer_id';

    protected $fillable = ['name', 'email', 'phone', 'address', 'password'];

    protected $hidden = ['password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}