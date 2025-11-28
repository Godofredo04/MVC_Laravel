<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Article;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('es_ES');
        for($i=0;$i<10;$i++){
            Article::create([
                'id_art'    => $faker -> unique() -> numberBetween(1, 10000),
                'titulo'    => $faker -> sentence(),
                'cuerpo'    => $faker -> paragraph(3, true),
            ]);
        }
    }
}
