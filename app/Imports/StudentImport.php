<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\Students;
use App\Models\Levels;
use App\Models\StudentLevel;
use App\Models\Subjects;
use App\Models\ScoreNormal;
use App\Models\ScoreSpecial;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
class StudentImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    // public function headingRow(): int
    // {
    //     return 1;
    // }

    public function collection(Collection $collection)
    {
    	
    	$data_excel = $collection->toArray();
    	// dd(array_splice($data_excel,1,count($data_excel)));
    	foreach (array_splice($data_excel,1,count($data_excel)) as $value) {
	    	$subjects = Subjects::all()->toArray();
		    $scores = [$value[6],$value[7]];

	        if ( $value[6] != null && $value[7] != null && $value[8] != null ) {
	        	session()->flash('error', 'Trong file excel này, dữ liệu điểm của 1 hoặc nhiều học viên đang được nhập cả 3 phần điểm');
	            return redirect()->route('students.create');
	        } else if ( $value[6] == null && $value[7] == null && $value[8] == null ) {
	        	session()->flash('error', 'Trong file excel này, dữ liệu điểm của 1 hoặc nhiều học viên chưa được nhập điểm');
	            return redirect()->route('students.create');
	        }

	    	$check_student = Students::where('student_code',$value[1])->first();
	    	
	    	if ($check_student == null) {
	    		// Thêm thông tin sinh viên
	    		$insert_student = Students::create([
					'name' => $value[0],
					'student_code' => $value[1],
					'birthday' => date('Y-m-d', strtotime($value[2])),
					'gender' => $value[3],
				]);

		    	if ($value[8] == null) {
	    			// Không có điểm đặc biệt thì thêm điểm thường
		    		if ($value[6] >= 135 && $value[7]  >= 45) {
		    			$status = config('common.status.passed');
		    		} 
		    		else {
		    			$status = config('common.status.failed');
		    		}
			    	$insert_student_level = StudentLevel::create([
			    		'id_student' => $insert_student->id,
			    		'id_level' => $value[4],
			    		'term' => date('Y-m-d', strtotime($value[5])),
			    		'status' => $status,
			    	]);

					
	    			if (count($scores) > count($subjects)) {
			            $count = count($subjects);
			        } else {
			            $count = count($scores);
			        }
	    			for ($i = 0 ; $i < $count ; $i++) {
			            $insert_score_normal = ScoreNormal::insert([
			            	'subject_id' => $subjects[$i]['id'],
			                'score_normal' => $scores[$i],
			                'id_student_level' => $insert_student_level->id,
			            ]);
	    			}
			        
	    		}
	    		else {
	    			// Có điểm đặc biệt thì thêm điểm đặc biệt

			    	$insert_student_level = StudentLevel::create([
			    		'id_student' => $insert_student->id,
			    		'id_level' => $value[4],
			    		'term' => date('Y-m-d', strtotime($value[5])),
			    		'status' => config('common.status.passed'),
			    	]);


			    	$insert_score_special = ScoreSpecial::insert([
			    		'id_student_level' => $insert_student_level->id,
			    		'score_special' => $value[8],
			    	]);
	    		}

	    	}
	    	else {
	    		$check_register = StudentLevel::where('id_student',$check_student->id)->where('id_level',$value[4])->where('term',date('Y-m-d', strtotime($value[5])))->first();

	    		if ($check_register == null) {
	    		
		    		if ($value[8] == null) {
		    			// Không có điểm đặc biệt thì thêm điểm thường
			    		if ($value[6] >= 135 && $value[7]  >= 45) {
			    			$status = config('common.status.passed');
			    		} 
			    		else {
			    			$status = config('common.status.failed');
			    		}
				    	$insert_student_level = StudentLevel::create([
				    		'id_student' => $check_student->id,
				    		'id_level' => $value[4],
				    		'term' => date('Y-m-d', strtotime($value[5])),
				    		'status' => $status,
				    	]);

						
		    			if (count($scores) > count($subjects)) {
				            $count = count($subjects);
				        } else {
				            $count = count($scores);
				        }
		    			for ($i = 0 ; $i < $count ; $i++) {
				            $insert_score_normal = ScoreNormal::insert([
				            	'subject_id' => $subjects[$i]['id'],
				                'score_normal' => $scores[$i],
				                'id_student_level' => $insert_student_level->id,
				            ]);
		    			}
				        
		    		}
		    		else {
		    			// Có điểm đặc biệt thì thêm điểm đặc biệt

				    	$insert_student_level = StudentLevel::create([
				    		'id_student' => $check_student->id,
				    		'id_level' => $value[4],
				    		'term' => date('Y-m-d', strtotime($value[5])),
				    		'status' => config('common.status.passed'),
				    	]);


				    	$insert_score_special = ScoreSpecial::insert([
				    		'id_student_level' => $insert_student_level->id,
				    		'score_special' => $value[8],
				    	]);
		    		}

	    		}
	    		else {
	    			session()->flash('error', 'Thông tin về 1 hoặc nhiều học viên trong file excel này đã tồn tại trong hệ thống! Những thông tin mới của các học viên còn lại(nếu có) cần phải tạo ra file excel mới!');
        			return redirect()->route('students.create');
	    		}
	    	}
	    		
    	}

    }


}
