<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Levels;
use App\Models\StudentLevel;
use App\Models\Subjects;
use App\Models\ScoreNormal;
use App\Models\ScoreSpecial;

use Yajra\Datatables\Datatables;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Request\Student\AddStudent;
use App\Http\Request\Student\EditStudent;
class StudentController extends Controller
{

    public function index()
    {
    	$levels = Levels::all();
        return view('admin.student.index',compact('levels'));
    }
    

    public function datatables(Request $request)
    {
        
        if(request()->ajax()) {
            if (!empty($request->get('searchByLevel'))) {
                $id = $request->get('searchByLevel');
                $students = Students::whereHas('studentLevels', function($query) use($id){
                    $query->where('id_level',$id);
                })->get();
            } else {
                $students = Students::all();
            }
            return Datatables::of($students)
                   ->editColumn('name', function ($student) {
                        return '<span style="text-transform: capitalize;">
                                    '.$student->name.'
                                </span>';
                    })
                   ->editColumn('birthday', function ($student) {
                        if ($student->birthday == null) {
                            return 'Chưa cập nhật';
                        } else {
                            return  date("d-m-Y", strtotime($student->birthday));
                        }
                    })
                   ->editColumn('email', function ($student) {
                        if ($student->email == null) {
                            return 'Chưa cập nhật';
                        } else {
                            return  $student->email;
                        }
                    })
                   ->editColumn('phone', function ($student) {
                        if ($student->phone == null) {
                            return 'Chưa cập nhật';
                        } else {
                            return  $student->phone;
                        }
                    })
                    ->addColumn('action', function ($student) {
                        return  
                        '<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                            <div class="m-dropdown__wrapper" style="z-index: 101;">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 21.5px;">
                                </span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__item">
                                                    <a href="'.route('students.edit',$student->id).'" class="m-nav__link">
                                                        <i class="m-nav__link-icon la la-edit text-success"></i>
                                                        <span class="m-nav__link-text">Chỉnh sửa thông tin</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a id="deleteStudent" linkurl="'.route('students.delete',$student->id).'" class="m-nav__link">
                                                        <i class="m-nav__link-icon la la-trash text-danger"></i>
                                                        <span class="m-nav__link-text">Xóa</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';

                    })
                    ->rawColumns(['name','action'])
                    ->make(true);
        }
    }

    public function create()
    {
        
        $levels = Levels::all();
        $subjects = Subjects::all();
        return view('admin.student.create',compact(['levels','subjects']));
    }

    public function store(AddStudent $request)
    {
    	$data = $request->except('_token');
        
        for ($i = 0 ; $i < count($request->score) ; $i++ ) {
            if ( $request->score[$i] == null && $request->score_special == null ) {
                $request->session()->flash('error', 'Vui lòng nhập hết điểm từng môn hoặc nhập điểm đặc biệt(nếu có)');
                return redirect()->route('students.create');
            } else if ( $request->score[$i] != null && $request->score_special != null ) {
                $request->session()->flash('error', 'Vui lòng chỉ nhập phần điểm từng phần hoặc phần điểm đặc biệt');
                return redirect()->route('students.create');
            }
        }
    	// Tìm xem có sinh viên đấy đã tồn tại hay chưa 
    	$check_student = Students::where('student_code',$request->student_code)->first();
    	// dd($student);
    	if ( $check_student == null ) {
    	
    		// Thêm cả thông tin và điểm
    		$data_student = [
    			'name' => $request->name,
    			'student_code' => $request->student_code,
    			'birthday' => date('Y-m-d', strtotime($request->birthday)),
    			'phone' => $request->phone,
    			'email' => $request->email,
    			'gender' => $request->gender,
    		];
    		$insert_student = Students::create($data_student);

    		if ($request->score_special == null) {
    			// Không có điểm đặc biệt thì thêm điểm thường
	    		if ($request->score[0] >= 135 && $request->score[1]  >= 45) {
	    			$status = config('common.status.passed');
	    		} 
	    		else {
	    			$status = config('common.status.failed');
	    		}
	    		$data_student_level = [
		    		'id_student' => $insert_student->id,
		    		'id_level' => $request->level,
		    		'term' => date('Y-m-d', strtotime($request->term)),
		    		'status' => $status,
		    	];

		    	$insert_student_level = StudentLevel::create($data_student_level);

		    	for ($i = 0; $i < count($request->score) ; $i++) { 
		            $data_score_normal = [
		                'subject_id' => $request->subject[$i],
		                'score_normal' => $request->score[$i],
		                'id_student_level' => $insert_student_level->id,
		            ];
		            $insertData[] = $data_score_normal;
		        }
		        $insert_score_normal = ScoreNormal::insert($insertData);

    		}
    		else {
    			// Có điểm đặc biệt thì thêm điểm đặc biệt
    			$data_student_level = [
		    		'id_student' => $insert_student->id,
		    		'id_level' => $request->level,
		    		'term' => date('Y-m-d', strtotime($request->term)),
		    		'status' => config('common.status.passed'),
		    	];

		    	$insert_student_level = StudentLevel::create($data_student_level);

		    	$data_score_special = [
		    		'id_student_level' => $insert_student_level->id,
		    		'score_special' => $request->score_special,
		    	];

		    	$insert_score_special = ScoreSpecial::insert($data_score_special);
    		}
    		$request->session()->flash('success', 'Thêm thành công!');
        	return redirect()->route('students.create');
    	}

    	else {
    		$check_register = StudentLevel::where('id_student',$check_student->id)->where('id_level',$request->level)->where('term',date('Y-m-d', strtotime($request->term)))->first();
    		// dd($check_register);
    		if ($check_register == null) {

	    		if ($request->score_special == null) {
	    			// Không có điểm đặc biệt thì thêm điểm thường
		    		if ($request->score[0] >= 135 && $request->score[1]  >= 45) {
		    			$status = config('common.status.passed');
		    		} 
		    		else {
		    			$status = config('common.status.failed');
		    		}
		    		$data_student_level = [
			    		'id_student' => $check_student->id,
			    		'id_level' => $request->level,
			    		'term' => date('Y-m-d', strtotime($request->term)),
			    		'status' => $status,
			    	];

			    	$insert_student_level = StudentLevel::create($data_student_level);

			    	for ($i = 0; $i < count($request->score) ; $i++) { 
			            $data_score_normal = [
			                'subject_id' => $request->subject[$i],
			                'score_normal' => $request->score[$i],
			                'id_student_level' => $insert_student_level->id,
			            ];
			            $insertData[] = $data_score_normal;
			        }
			        $insert_score_normal = ScoreNormal::insert($insertData);

	    		}
	    		else {
	    			// Có điểm đặc biệt thì thêm điểm đặc biệt
	    			$data_student_level = [
			    		'id_student' => $check_student->id,
			    		'id_level' => $request->level,
			    		'term' => date('Y-m-d', strtotime($request->term)),
			    		'status' => config('common.status.passed'),
			    	];

			    	$insert_student_level = StudentLevel::create($data_student_level);

			    	$data_score_special = [
			    		'id_student_level' => $insert_student_level->id,
			    		'score_special' => $request->score_special,
			    	];

			    	$insert_score_special = ScoreSpecial::insert($data_score_special);
	    		}

    		}
    		else {
    			$request->session()->flash('error', 'Thông tin về học viên này trong kì thi ngày '.$request->term.' đã tồn tại!');
        		return redirect()->route('students.create');
    		}
    		$request->session()->flash('success', 'Thêm thành công!');
        	return redirect()->route('students.create');

    	}

    }

    public function import(Request $request)
    {
        $request->validate([
            'import_excel' => 'required|max:5000|mimes:xlsx,xls',
        ], [
            'import_excel.required' => 'Vui lòng chọn file',
            'import_excel.mimes' => 'Vui lòng chỉ chọn file excel',
            'import_excel.max' => 'File có dung lượng tối đa 5M',
        ]);
    	if ($request->hasFile('import_excel')) {
    		$path = $request->file('import_excel')->getRealPath();
    		
    		
    		$data = Excel::import(new StudentImport, $request->file('import_excel'));
    		// dd($data);
    		$request->session()->flash('success', 'Import thành công!');
        	return redirect()->route('students.index');
    	}
    	
    	
    }

    public function destroy(Request $request, $id) {
        $student = Students::findOrFail($id);
        $student_level = StudentLevel::where('id_student',$id)->first();

        $check_score_normal = ScoreNormal::where('id_student_level',$student_level->id)->get();
        $check_score_special = ScoreSpecial::where('id_student_level',$student_level->id)->get();
        if (count($check_score_special) > 0 ) {
            $delete_score_special = ScoreSpecial::where('id_student_level',$student_level->id)->delete();
        } else {
            $delete_score_normal = ScoreNormal::where('id_student_level',$student_level->id)->delete();
        }

        $student->delete();
        $delete_student_level = StudentLevel::where('id_student',$id)->delete();
        return response(['msg' => 'Xóa thành công!', 'status' => 'success']);
    }

    public function edit($id)
    {
        $student = Students::findOrFail($id);
        return view('admin.student.edit',compact('student'));
    }


    public function update(EditStudent $request, $id)
    {
        $student = $request->except('_token');
        $student = Students::findOrFail($id);
        $data = [
            'name' => $request->name,
            'student_code' => $request->student_code,
            'birthday' => date('Y-m-d', strtotime($request->birthday)),
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
        ];
        $student->update($data);
        $request->session()->flash('success', 'Cập nhật thành công!');
        return redirect()->back();
    }


}
