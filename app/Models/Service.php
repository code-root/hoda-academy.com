<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable =['title_ar','title_en','quote_ar','quote_en','overview_ar','overview_en','description_ar','description_en','photo','page' ];



    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('service', 'service'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('service', 'service');
        } else {
            $this->attributes['photo'] = $value;
        }
    }
}
