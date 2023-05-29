<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                UserSeeder::class,
                BotUsersTableSeeder::class,
                CourseSeeder::class,
                LessonCategorySeeder::class,
                LessonSeeder::class,
                ContentSeeder::class,
                VideoFileSeeder::class,
                LessonJoinCategorySeeder::class,
                ContentJoinLessonSeeder::class,
            ]
        );
    }
}
