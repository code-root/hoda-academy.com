<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'counter1',
        'counter2',
        'counter3',
        'counter4',
        'photo',
        'phone',
        'email',
        'location',
        'facebook',
        'youtube',
        'x',
        'instagram',
        'name',
        'ZOOM_ACCOUNT_ID',
        'ZOOM_CLIENT_SECRET',
        'ZOOM_CLIENT_KEY',
        'photo_about',
        'photo_services',
        'photo_products',
        'photo_faq',
        'photo_contact',
        'color',
        'background_color',
        'color_h',
        'color_header',
        'Contact',
        'FAQ',
        'Sessions',
        'Products',
        'Services',
        'About',
        'Story',
        'Blogs',

    ];

    public function setImageAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        'photo' => $file->store('setting', 'setting'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes['photo'] = $value->store('setting', 'setting');
        } else {
            $this->attributes['photo'] = $value;
        }
    }




    public function setImageAttribute1($value)
    {


        if (is_array($value)) {
            foreach ($value as $file) {
                if (is_file($file) and !empty($file)) {
                      self::update([
                        $value[1] => $file->store('setting', 'setting'),
                    ]);
                }
            }
        }elseif (is_file($value)) {
            $this->attributes[$value[1]] = $value->store('setting', 'setting');
        } else {
            $this->attributes[$value[1]] = $value;
        }
    }
}
