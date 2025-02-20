<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Courses_Item extends Model
{
    use HasFactory;
    protected $table = 'courses_items';
    protected $fillable =['name_ar','name_en','course_id','description_ar','description_en' ];
    public function courses()
    {
        return $this->belongsTo(Courses::class );
    }
}
