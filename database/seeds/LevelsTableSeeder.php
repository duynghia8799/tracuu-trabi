<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('levels')->count() == 0 ) {
        	DB::table('levels')->insert([
        		[
        			'level_name' => 'Trình độ B1',
        			'description' => 'Đây là trình độ B1',
        		],
        		[
        			'level_name' => 'Trình độ B2',
        			'description' => 'Đây là trình độ B2',
        		],
        	]);
        }
    }
}
