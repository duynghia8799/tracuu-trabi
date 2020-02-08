<?php

use Illuminate\Database\Seeder;

class ScoreNormalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('scores_normal')->count() == 0 ) {
        	DB::table('scores_normal')->insert([
        		[
        			'subject_id' => 1,
        			'score_normal' => 135,
        			'id_student_level' => 1,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 45,
        			'id_student_level' => 1,
        		],
        		[
        			'subject_id' => 1,
        			'score_normal' => 70,
        			'id_student_level' => 3,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 10,
        			'id_student_level' => 3,
        		],
        		[
        			'subject_id' => 1,
        			'score_normal' => 135,
        			'id_student_level' => 4,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 45,
        			'id_student_level' => 4,
        		],
        		[
        			'subject_id' => 1,
        			'score_normal' => 120,
        			'id_student_level' => 5,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 30,
        			'id_student_level' => 5,
        		],
        		[
        			'subject_id' => 1,
        			'score_normal' => 110,
        			'id_student_level' => 6,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 35,
        			'id_student_level' => 6,
        		],
        		[
        			'subject_id' => 1,
        			'score_normal' => 128,
        			'id_student_level' => 7,
        		],
        		[
        			'subject_id' => 2,
        			'score_normal' => 32,
        			'id_student_level' => 7,
        		],
        	]);
        }
    }
}
