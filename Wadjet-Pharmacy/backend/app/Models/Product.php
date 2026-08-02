<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory;

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'category_id',
        'supplier_id',
        'admin_id',
        'name',
        'description',
        'image',
        'barcode',
        'price',
        'quantity',
        'status',
        'has_offer',
        'offer_value',
        'start_offer',
        'end_offer',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'offer_value' => 'decimal:2',
            'has_offer' => 'boolean',
            'start_offer' => 'date',
            'end_offer' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}