<?php

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
        $this->call([
            SubjectsTableSeeder::class,
        	LevelsTableSeeder::class,
        	StudentsTableSeeder::class,
        	StudentLevelTableSeeder::class,
        	ScoreNormalTableSeeder::class,
        	ScoreSpecialTableSeeder::class,
            UsersTableSeeder::class,
        ]); 
    }
}
