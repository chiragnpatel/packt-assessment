<?php

namespace App\Console\Commands;

use App\Helpers\ProductsSyncHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SyncProducts extends Command
{
    const PRIVATE = 'private';
    const CHILD = 'child';
    /**
     * The name and signature of the console command.
     * for can be 'parent' or 'child'
     * parent = 'Products Table'
     * child = 'Product Detail Table'
     * @var string
     */
    protected $signature = 'product:sync-products {for=parent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Sync Products to Local Database. Pass 'parent' if you want sync products for products table or Pass 'child' if you want sync product details for product_details table";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $syncFor = strtolower(trim($this->argument('for')));
        $message = "Products Master Table!";
        if ($syncFor == self::CHILD) {
            $message = "Product Detail Table!";
        }
        $this->warn('------------------------------------------------------------------------');
        $this->warn(" This command will sync data to " . $message);
        $this->warn('------------------------------------------------------------------------');
        if ($syncFor == self::CHILD) {
            $this->child();
        } else {
            $this->parent();
        }
    }

    private function parent()
    {
        Artisan::call('product:flush-product-table');
        $syncProductsData = new ProductsSyncHelper();
        $syncProductsData->getProducts();
    }

    private function child()
    {
        $syncProductsData = new ProductsSyncHelper();
        $syncProductsData->getProductDetail();
    }
}
