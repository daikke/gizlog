<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            AdminUsersTableSeeder::class,
            UsersTableSeeder::class,
            TagCategoriesSeeder::class,
            DailyReportsTableSeeder::class,
            CommentsTableSeeder::class,
            QuestionTagCategoryTableSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

