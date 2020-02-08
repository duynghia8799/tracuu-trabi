<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentLevel;
class ScoreSpecial extends Model
{
    protected $table = 'scores_special';
    protected $fillable = [
    	'id_student_level',
    	'score_special',
    ];
    public function studentLevel()
    {
    	return $this->belongsTo(StudentLevel::class);
    }
}
