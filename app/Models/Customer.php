<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


 use Laravel\Sanctum\HasApiTokens;
 class Customer extends Authenticatable
{
    use HasApiTokens ;
    use HasFactory;
    use Notifiable;
    protected $fillable =['name','email', 'password',  'remember_token' , 'status', 'age', 'phone', 'country_id'];


    protected $guard = 'customer';


    protected $hidden = ['password', 'remember_token'];
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    public function product()  {
        return $this->belongsTo(Product::class,'product_id');
    }


    public function order()
    {
        return $this->hasMany(Order::class);

    }

    // public function visa()
    // {
    //     return $this->hasMany(Visa::class);
    // }

    public function orders()  {
        return $this->hasMany(Order::class,'customer_id');

    }

    public function booking()  {
        return $this->hasMany(Booking::class,'customer_id');

    }

    public function order_pro()  {
        return $this->hasMany(Order_Pro::class,'customer_id');

    }

    public function country()  {
        return $this->belongsTo(Country::class,'country_id');
    }
}
