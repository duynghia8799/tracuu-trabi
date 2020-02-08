<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StudentLevel;
class Levels extends Model
{
	protected $table = 'levels';
    protected $fillable = [
    	'level_name',
    	'description',
    ];

    public function studentLevels()
    {
    	return $this->hasMany(StudentLevel::class,'id_level');
    }
}
