<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( DB::table('students')->count() == 0 ) {
        	DB::table('students')->insert([
        		[
        			'name' => 'Mai Duy Nghĩa',
        			'student_code' => '082323942',
        			'birthday' => '1999-07-08',
        			'phone' => '0347918403',
        			'email' => 'maiduynghia87@gmail.com',
        			'gender' => 'male',
        		],
        		[
        			'name' => 'Nguyễn Tố Như',
        			'student_code' => '082323943',
        			'birthday' => '2000-01-16',
        			'phone' => '0364731718',
        			'email' => 'nguyentonhu16@gmail.com',
        			'gender' => 'female',
        		],
        		[
        			'name' => 'Lâm Vỹ Dạ',
        			'student_code' => '082323944',
        			'birthday' => '2000-02-16',
        			'phone' => '0363731718',
        			'email' => 'lamvyda@gmail.com',
        			'gender' => 'female',
        		],
        	]);
        }
    }
}
