<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Levels;
use App\Models\Students;
use App\Models\StudentLevel;
use App\Models\ScoreNormal;
use App\Models\ScoreSpecial;

use App\Http\Request\Level\AddLevel;
use App\Http\Request\Level\EditLevel;
class LevelController extends Controller
{
    public function index() {
    	$levels = Levels::all();
    	return view('admin.level.index',compact('levels'));
    }

    public function create()
    {
    	return view('admin.level.create');
    }

    public function store(AddLevel $request)
    {
    	$data = $request->except('_token');
    	$data = $request->all();
    	$course = Levels::create($data);
    	$request->session()->flash('success', 'Thêm thành công!');
        return redirect()->route('levels.index');
    }

    public function edit($id)
    {
    	$level = Levels::findOrFail($id);
    	return view('admin.level.edit',compact('level'));
    	
    }

    public function update(EditLevel $request,$id) {
    	$level = $request->except('_token');
        $level = Levels::findOrFail($id);
        $data = [
        	'level_name' => $request->level_name,
        	'description' => $request->description,
        ];
        $level->update($data);
        $request->session()->flash('success', 'Cập nhật thành công!');
        return redirect()->back();
    }

    public function destroy(Request $request, $id) {
    	$delete_level = Levels::findOrFail($id);
    	$check_student_level = StudentLevel::where('id_level',$id)->get();
    	
    	foreach ($check_student_level as $infor) {
    		$delete_score_normal = ScoreNormal::where('id_student_level',$infor->id)->delete();
    		$delete_score_special = ScoreSpecial::where('id_student_level',$infor->id)->delete();
    		$delete_student = Students::where('id',$infor->id_student)->delete();
    	}
    	
    	$delete_student_level = StudentLevel::where('id_level',$id)->delete();
    	$delete_level->delete();
    	$request->session()->flash('success', 'Xóa thành công!');
        return redirect()->back();
    }
}
