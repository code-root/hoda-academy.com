<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Mail\NewBlogNotification;
use App\Models\Blog;
use App\Models\BlogDescription;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index');
    }

    public function data()
    {
        $blogs = Blog::with('user:id,name_ar,name_en,email')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'title_en', 'title_ar', 'user_id', 'photo']);

        return DataTables::of($blogs)
            ->addColumn('title', function ($blog) {
                return app()->getLocale() == 'en' ? ($blog->title_en ?: $blog->title_ar) : ($blog->title_ar ?: $blog->title_en);
            })
            ->addColumn('title_ar', function ($blog) {
                return $blog->title_ar;
            })
            ->addColumn('title_en', function ($blog) {
                return $blog->title_en;
            })
            ->addColumn('photo', function ($blog) {
                return $blog->photo;
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(BlogRequest $request)
    {
        try {
            $data = $request->except('photo', 'title_ar1', 'title_en1', 'description_ar1', 'description_en1');
            
            if ($request->hasFile('photo')) {
                $data['photo'] = $request->file('photo');
            }
            
            $blog = Blog::create($data);

            if (!empty($request->title_ar1)) {
                foreach ($request->title_ar1 as $key => $value) {
                    BlogDescription::create([
                        'blog_id' => $blog->id,
                        'title_ar' => $request->title_ar1[$key],
                        'title_en' => $request->title_en1[$key],
                        'description_ar' => $request->description_ar1[$key],
                        'description_en' => $request->description_en1[$key],
                    ]);
                }
            }

            event(new SendMail($blog, 'blog'));

            session()->flash('success', __('admin.Created Successfully'));
            return redirect()->route('blog.index');
        } catch (\Exception $e) {
            Log::error('Blog Store Error: ' . $e->getMessage());
            return back()->withErrors(['error' => __('admin.Error occurred while creating blog') . ': ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $data = $request->except('photo', 'title_ar1', 'title_en1', 'description_ar1', 'description_en1');
            
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($blog->photo) {
                    Storage::disk('blog')->delete($blog->photo);
                }
                $data['photo'] = $request->file('photo');
            }
            
            $blog->update($data);

            if (!empty($request->title_ar1)) {
                BlogDescription::where('blog_id', $blog->id)->delete();
                foreach ($request->title_ar1 as $key => $value) {
                    BlogDescription::create([
                        'blog_id' => $blog->id,
                        'title_ar' => $request->title_ar1[$key],
                        'title_en' => $request->title_en1[$key],
                        'description_ar' => $request->description_ar1[$key],
                        'description_en' => $request->description_en1[$key],
                    ]);
                }
            }

            session()->flash('success', __('admin.Updated Successfully'));
            return redirect()->route('blog.index');
        } catch (\Exception $e) {
            Log::error('Blog Update Error: ' . $e->getMessage());
            return back()->withErrors(['error' => __('admin.Error occurred while updating blog') . ': ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $ex = explode(',', $request->id);

            foreach ($ex as $value) {
                $blog = Blog::findOrFail($value);
                
                if ($blog->photo) {
                    Storage::disk('blog')->delete($blog->photo);
                }
                
                $blog->delete();
            }

            session()->flash('success', __('admin.Deleted Successfully'));
            return redirect()->route('blog.index');
        } catch (\Exception $e) {
            Log::error('Blog Delete Error: ' . $e->getMessage());
            session()->flash('error', __('admin.Error occurred while deleting blog'));
            return redirect()->back();
        }
    }
}

