<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function boot()
    {
        parent::boot();

        // عند حفظ المنتج (إضافة أو تعديل)
        static::saving(function ($blog) {
             if (!$blog->slug) {
                $blog->slug_ar = str_replace(' ', '-', $blog->title_ar) . '-' . $blog->id;
                $blog->slug_en = Str::slug($blog->title_en . '-' . $blog->id);
            } else {
                $blog->slug_ar = str_replace(' ', '-', $blog->title_ar) . '-' . $blog->id;


                $blog->slug_en = Str::slug($blog->title_en . '-' . $blog->id);
            }
        });
    }



    public function setImageAttribute($value)
    {
        // Handle multiple files (array of UploadedFile)
        if (is_array($value)) {
            $paths = [];
            foreach ($value as $file) {
                if (is_file($file) && !empty($file)) {
                    $paths[] = $file->store('blog', 'blog');
                }
            }
            // Store as JSON if multiple images
            $this->attributes['image'] = json_encode($paths);
        } elseif (is_file($value)) {
            // Single file upload
            $this->attributes['image'] = $value->store('blog', 'blog');
        } else {
            // Existing path or string
            $this->attributes['image'] = $value;
        }
    }

    public function blogComment()  {
        return $this->hasMany(BlogComment::class);

    }

    public function blogDescription()  {
        return $this->hasMany(BlogDescription::class,'blog_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class );
    }
}
