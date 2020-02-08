<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Levels;
use App\Models\ScoreNormal;
use App\Models\ScoreSpecial;
class StudentLevel extends Model
{
	protected $table = 'student_level';
    protected $fillable = [
    	'id_student',
    	'id_level',
    	'term',
    	'status',
    ];

    public function student()
    {
    	return $this->belongsTo(Students::class,'id_student');
    }
    public function level()
    {
    	return $this->belongsTo(Levels::class,'id_level');
    }
    public function scoreSpecials()
    {
    	return $this->hasMany(ScoreSpecial::class,'id_student_level');
    }
    public function scoreNormals()
    {
    	return $this->hasMany(ScoreNormal::class,'id_student_level');
    }
}
