<?php

use Illuminate\Database\Seeder;

class ScoreSpecialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('scores_special')->count() == 0 ) {
        	DB::table('scores_special')->insert([
        		[
        			'score_special' => 300,
        			'id_student_level' => 2,
        		],
        	]);
        }
    }
}
