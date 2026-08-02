<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityRequest extends Model
{
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'product_id',
        'admin_id',
        'product_name',
        'customer_name',
        'phone',
        'address',
        'notes',
        'status',
        'pending',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}