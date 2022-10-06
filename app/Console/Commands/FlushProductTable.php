<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class FlushProductTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:flush-product-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It will flush the product master table before sync product data!';

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
        Product::truncate();
    }
}
