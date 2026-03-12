<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class SyncProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productData;

    public function __construct($productData)
    {
        $this->productData = $productData;
    }

    public function handle()
    {
        $data = $this->productData;

        // Make sure Category exists
        $category = Category::firstOrCreate(
            ['id' => $data['category_ids'][0]],
            ['name' => 'Category '.$data['category_ids'][0]]
        );

        // Insert / Update Product
        Product::updateOrCreate(
            ['sku' => $data['sku']],
            [
                'external_id' => $data['external_product_id'],
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'special_price' => $data['special_price'],
                'category_id' => $category->id,
                'stock_qty' => $data['qty'],
                'status' => $data['status'],
                'image' => $data['image'],
                'synced_at' => now()
            ]
        );
        Cache::flush();
    }
}