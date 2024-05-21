<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name'=>'scientific'
        ]);
        Category::create([
            'name'=>'cultural'
        ]);
        Category::create([
            
            'name'=>'entertainment'
        ]);
    }
}
