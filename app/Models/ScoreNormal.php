<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subjects;
use App\Models\StudentLevel;
class ScoreNormal extends Model
{
    protected $table = 'scores_normal';
    protected $fillable = [
    	'subject_id',
    	'score_normal',
    	'id_student_level',
    ];
    public function subject()
    {
    	return $this->belongsTo(Subjects::class);
    }
    public function studentLevel()
    {
    	return $this->belongsTo(StudentLevel::class);
    }
}
