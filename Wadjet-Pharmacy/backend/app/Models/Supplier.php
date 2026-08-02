<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'address'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }
}