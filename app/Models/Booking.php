<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'time', 'token',  'course_id' , 'date', 'total', 'payment', 'country'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

}
