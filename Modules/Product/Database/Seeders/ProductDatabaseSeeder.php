<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\App\Models\Product;
use Modules\Product\Database\Factories\ProductFactory;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductFactory::new()->count(1)->create();

    }
}
