<?php

namespace Database\Seeders;

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
        \App\models\Categories::factory()->create(["name" => "Orixá"]);
        \App\models\Categories::factory()->create(["name" => "Guia"]);
        \App\models\Categories::factory()->create(["name" => "Outros"]);
    }
}
