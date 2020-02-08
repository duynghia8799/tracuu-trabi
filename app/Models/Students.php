<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentLevel;
class Students extends Model
{
    protected $table = 'students';
    protected $fillable = [
    	'name',
    	'student_code',
    	'birthday',
    	'phone',
    	'email',
        'gender',
    ];

    public function studentLevels()
    {
    	return $this->hasMany(StudentLevel::class,'id_student');
    }
}
