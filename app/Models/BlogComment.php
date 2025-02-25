<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'blog_id',
        'customer_id',

        'comment',
        'ip_address',
        'name',
        'email',
    ];

    public function blog()  {
        return $this->belongsTo(Blog::class );

    }
public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
