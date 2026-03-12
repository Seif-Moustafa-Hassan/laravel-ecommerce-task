<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;



class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'products_page_' . $request->get('page', 1) . '_' . md5(json_encode($request->all()));

        $products = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Product::query();

            // Filtering
            if ($request->filled('sku')) {
                $query->where('sku', 'like', '%'.$request->sku.'%');
            }

            if ($request->filled('name')) {
                $query->where('name', 'like', '%'.$request->name.'%');
            }

            if ($request->filled('category')) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->category.'%');
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Sorting
            $sortBy = $request->get('sort_by', 'id');
            $sortOrder = $request->get('sort_order', 'desc');
            $query->orderBy($sortBy, $sortOrder);

            // Pagination
            $perPage = $request->get('per_page', 10);
            return $query->paginate($perPage);
        });

        return response()->json($products);
    }

    public function show($id)
    {
        $cacheKey = 'product_' . $id;

        $product = Cache::remember($cacheKey, 60, function () use ($id) {
            return Product::with('category')->find($id);
        });

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json($product);
    }

    public function syncProducts()
    {
        try {
            // Call the artisan command
            Artisan::call('products:sync');

            $output = Artisan::output();

            return response()->json([
                'message' => 'Product sync triggered successfully.',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to trigger product sync.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}