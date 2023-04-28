<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Categories::factory()->create([
            'category' => 'Orixá',
        ]);
        Categories::factory()->create([
            'category' => 'Guia',
        ]);
        Categories::factory()->create([
            'category' => 'Outros',
        ]);
    }
}
