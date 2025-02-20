<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses_Review extends Model
{
    use HasFactory;
    protected $table = 'courses_reviews';

    protected $fillable = [
        'course_id',
        'customer_id',
        'rate',
        'review',
        'ip_address',
        'name',
        'email',
    ];

    public function course()  {
        return $this->belongsTo(Courses::class,'course_id');
    }
public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
