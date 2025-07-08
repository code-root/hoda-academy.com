<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rateing extends Model
{
    use HasFactory;
    
    protected $table = 'rateings';
    protected $guarded = [];

    public function setImageAttribute($value)
    {
        if (is_array($value) && count($value) >= 2) {
            $file = $value[0];
            $attribute = $value[1];
            
            if (is_file($file) && !empty($file)) {
                $this->attributes[$attribute] = $file->store('rateing', 'rateing');
            }
        } elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('rateing', 'rateing');
        } else {
            $this->attributes['photo'] = $value;
        }
    }
}
