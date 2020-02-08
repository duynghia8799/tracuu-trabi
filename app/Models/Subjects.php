<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ScoreNormal;
class Subjects extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
    	'subject_name',
    	'description',
    ];
    public function scoreNormals()
    {
    	return $this->hasMany(ScoreNormal::class,'subject_id');
    }
}
