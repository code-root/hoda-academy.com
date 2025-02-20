<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses_Time extends Model
{
    protected $table = 'courses_times';
    use HasFactory;
    protected $fillable = [
        'course_id',
        'start_time',
        'end_time',

    ];

    public function course()  {
        return $this->belongsTo(Courses::class,'course_id');
    }
}
