<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\MockMagentoController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Jobs\SyncProductJob;
use App\Models\ProductSyncLog;

class SyncProducts extends Command
{
    protected $signature = 'products:sync';
    protected $description = 'Sync products from external source';

    public function handle(MockMagentoController $mockController)
    {
        $total = 0;

    
        $this->info('Fetching products from mock API...');

        // Instead of HTTP call
        $products = $mockController->products(); // returns JSON array

        // If the controller returns a Response object, decode it:
        if ($products instanceof \Illuminate\Http\JsonResponse) {
            $products = $products->getData(true);
        }

        $total = count($products);

        foreach ($products as $product) {
            SyncProductJob::dispatch($product);
        }

        $this->info($total . ' products dispatched to queue.');
    }
}