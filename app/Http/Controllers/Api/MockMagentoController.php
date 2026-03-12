<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MockMagentoController extends Controller
{
    public function products()
    {
        $products = [
            [
                "entity_id" => 1,
                "sku" => "iphone-15",
                "name" => "iPhone 15",
                "price" => 1200,
                "special_price" => 1100,
                "status" => 1,
                "qty" => 50,
                "category_ids" => [1],
                "image" => "iphone.jpg",
                "updated_at" => now(),
                "external_product_id" => "EXT-1",
                "description" => "Latest iPhone model"
            ],
            [
                "entity_id" => 2,
                "sku" => "samsung-s24",
                "name" => "Samsung Galaxy S24",
                "price" => 1000,
                "special_price" => 950,
                "status" => 1,
                "qty" => 40,
                "category_ids" => [1],
                "image" => "s24.jpg",
                "updated_at" => now(),
                "external_product_id" => "EXT-2",
                "description" => "Samsung flagship phone"
            ],
            [
                "entity_id" => 3,
                "sku" => "macbook-m3",
                "name" => "MacBook M3",
                "price" => 2500,
                "special_price" => 2300,
                "status" => 1,
                "qty" => 15,
                "category_ids" => [2],
                "image" => "macbook.jpg",
                "updated_at" => now(),
                "external_product_id" => "EXT-3",
                "description" => "Apple MacBook with M3 chip"
            ]
        ];

        return response()->json($products);
    }
}
