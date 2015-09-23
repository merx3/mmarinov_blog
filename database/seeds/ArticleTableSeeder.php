<?php

use Illuminate\Database\Seeder;
use App\Articles;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articles::truncate();

        factory(Articles::class, 20)->create();
    }
}
