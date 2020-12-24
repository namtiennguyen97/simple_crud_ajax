<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pro = new Product();
        $pro->name = 'Nam';
        $pro->price = 23131;
        $pro->category_id = 1;
        $pro->save();

        $pro = new Product();
        $pro->name = 'Tien';
        $pro->price = 232311;
        $pro->category_id = 2;
        $pro->save();

        $pro = new Product();
        $pro->name = 'Nguyen';
        $pro->price = 123211;
        $pro->category_id = 3;
        $pro->save();
    }
}
