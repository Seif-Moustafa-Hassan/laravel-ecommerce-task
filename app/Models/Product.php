<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'sku',
        'name',
        'description',
        'price',
        'special_price',
        'category_id',
        'stock_qty',
        'status',
        'image',
        'synced_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
