<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    DB::table('categories')->insert([
        ['title' => 'Electronics', 'details' => 'Electronic items'],
        ['title' => 'Clothing', 'details' => 'Apparel and clothing'],
    ]);
}
}