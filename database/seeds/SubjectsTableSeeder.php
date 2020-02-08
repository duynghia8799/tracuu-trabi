<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('subjects')->count() == 0 ) {
        	DB::table('subjects')->insert([
        		[
        			'subject_name' => 'Phần viết (Schriftliche Prüfung)',
        			'description' => 'Đây là phần thi viết',
        		],
        		[
        			'subject_name' => 'Phần nói (Mündlich Prüfung)',
        			'description' => 'Đây là phần thi nói',
        		],
        	]);
        }
    }
}
