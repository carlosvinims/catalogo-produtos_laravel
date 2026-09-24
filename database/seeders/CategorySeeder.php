<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::updateOrCreate(
            ['name' => 'Eletônicos'],
            ['slug' => 'eletronicos']
        );

         Category::updateOrCreate(
            ['name' => 'Periféricos'],
            ['slug' => 'perifericos']
        );

         Category::updateOrCreate(
            ['name' => 'Hardware'],
            ['slug' => 'hardware']
        );

         Category::updateOrCreate(
            ['name' => 'Acessórios'],
            ['slug' => 'acessorios']
        );

        Category::updateOrCreate(
            ['name' => 'Áudio & Vídeo'],
            ['slug' => 'audio_e_video'] 
        );
    }
}
