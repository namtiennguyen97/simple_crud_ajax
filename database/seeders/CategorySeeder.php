<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate = new Category();
        $cate->id = 1;
        $cate->name = 'Men';
        $cate->save();

        $cate = new Category();
        $cate->id = 2;
        $cate->name = 'Women';
        $cate->save();

        $cate = new Category();
        $cate->id = 3;
        $cate->name = 'Kid';
        $cate->save();

    }
}
