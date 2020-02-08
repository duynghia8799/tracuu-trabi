<?php

use Illuminate\Database\Seeder;

class StudentLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('student_level')->count() == 0 ) {
        	DB::table('student_level')->insert([
        		[
        			'id_student' => 1,
        			'id_level' => 1,
        			'term' => '2019-05-08',
        			'status' => 1,
        		],
        		[
        			'id_student' => 1,
        			'id_level' => 2,
        			'term' => '2019-09-13',
        			'status' => 1,
        		],
        		[
        			'id_student' => 2,
        			'id_level' => 1,
        			'term' => '2019-05-08',
        			'status' => 0,
        		],
        		[
        			'id_student' => 2,
        			'id_level' => 1,
        			'term' => '2019-09-13',
        			'status' => 1,
        		],
        		[
        			'id_student' => 2,
        			'id_level' => 2,
        			'term' => '2019-12-08',
        			'status' => 1,
        		],
        		[
        			'id_student' => 3,
        			'id_level' => 1,
        			'term' => '2019-05-08',
        			'status' => 1,
        		],
        		[
        			'id_student' => 3,
        			'id_level' => 2,
        			'term' => '2019-09-13',
        			'status' => 1,
        		],
        	]);
        }
    }
}
