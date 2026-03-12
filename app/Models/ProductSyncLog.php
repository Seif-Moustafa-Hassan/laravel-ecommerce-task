<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSyncLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_products',
        'created',
        'updated',
        'failed',
        'message'
    ];
}
