<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // DB::table('categories')->insert([
        //     'name' => 'categorie ',
        // ]);
        for ($i = 0; $i <= 10; $i++) {
            Category::create([
                'name' => 'categorie ' . $i,
            ]);
        }

    }
}