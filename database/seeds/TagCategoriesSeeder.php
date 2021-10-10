<?php

use Illuminate\Database\Seeder;

class TagCategoriesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('tag_categories')->truncate();
        DB::table('tag_categories')->insert([
            [
                'name' => 'front',
            ],
            [
                'name' => 'back',
            ],
            [
                'name' => 'infra',
            ],
            [
                'name' => 'others',
            ],
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

