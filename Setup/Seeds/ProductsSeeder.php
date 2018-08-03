<?php

namespace IrishTitan\Handshake\Setup\Seeds;

use IrishTitan\Handshake\Contracts\SeederContract;
use IrishTitan\Handshake\Core\Database\Seeder;
use IrishTitan\Handshake\Facades\Product;

class ProductsSeeder extends Seeder implements SeederContract
{

    /**
     * Run the seeder.
     *
     */
    public function run()
    {
        Product::create([

        ]);
    }

}