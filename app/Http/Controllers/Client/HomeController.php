<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Levels;
use App\Models\Students;
use App\Models\StudentLevel;
use App\Models\ScoreNormal;
use App\Models\ScoreSpecial;
class HomeController extends Controller
{
    public function index()
    {
    	$levels = Levels::all();
    	return view('client.index',compact('levels'));
    }

    public function search(Request $request)
    {
    	$levels = Levels::all();
    	$data = $request->except('_token');
    	$data = $request->all();
    	
    	$validate = $request->validate([
            'student_code' => 'required|string|max:20',
            'term' => 'required',
        ], [

            'student_code.required' => 'Vui lòng nhập CMND hoặc Hộ chiếu',
            'student_code.digits_between' => 'Số CMND hoặc Hộ chiếu có độ dài tối đa 20 kí tự',

            'term.required' => 'Vui lòng chọn kì thi đã đăng ký',
            
        ]);
        $student = Students::where('student_code',$data['student_code'])->first();
        if ($student != null) {
            $check_student_level = StudentLevel::where('id_student',$student->id)->where('id_level',$data['level'])->with('student')->get();
            for ($i=0; $i < count($check_student_level); $i++) { 

                // Check kì thi ( Chỉ check tháng và năm)
                if ( date('Y-m', strtotime($check_student_level[$i]['term'])) === $data['term'] ) {
                    $result_score_normal = ScoreNormal::where('id_student_level',$check_student_level[$i]['id'])->get() ;
                    $result_score_special = ScoreSpecial::where('id_student_level',$check_student_level[$i]['id'])->get() ;
                    if ( count($result_score_special) > 0 ) {
                        $exaclly_result_special = $result_score_special;
                        $infor_level = $check_student_level[$i];
                        $request->session()->flash('success', 'Chúc mừng bạn đã ở mức điểm tuyệt đối!');
                        return view('client.index',compact(['exaclly_result_special','levels','infor_level']));
                    } else {
                        $exaclly_result_normal = $result_score_normal;
                        $infor_level = $check_student_level[$i];
                        return view('client.index',compact(['exaclly_result_normal','levels','infor_level']));
                    }
                } else {
                    $request->session()->flash('error', true);
                    return redirect()->route('homepage');
                }
            }
        } else {
            $request->session()->flash('error', true);
            return redirect()->route('homepage');
        }
        // dd($student);
        
        for ($i=0; $i < count($check_student_level); $i++) { 

        	// Check kì thi ( Chỉ check tháng và năm)
        	if ( date('Y-m', strtotime($check_student_level[$i]['term'])) === $data['term'] ) {
        		$result_score_normal = ScoreNormal::where('id_student_level',$check_student_level[$i]['id'])->get() ;
        		$result_score_special = ScoreSpecial::where('id_student_level',$check_student_level[$i]['id'])->get() ;
        		if ( count($result_score_special) > 0 ) {
        			$exaclly_result_special = $result_score_special;
        			$infor_level = $check_student_level[$i];
        			$request->session()->flash('success', 'Chúc mừng bạn đã ở mức điểm tuyệt đối!');
        			return view('client.index',compact(['exaclly_result_special','levels','infor_level']));
        		} else {
        			$exaclly_result_normal = $result_score_normal;
        			$infor_level = $check_student_level[$i];
        			return view('client.index',compact(['exaclly_result_normal','levels','infor_level']));
        		}
        	} else {
        		$request->session()->flash('error', true);
            	return redirect()->route('homepage');
        	}
        }
        

    }
}
