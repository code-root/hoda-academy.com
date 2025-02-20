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
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index');
    }

    public function data()
    {
        $blog = Blog::with('user:id,name_ar,name_en,email')
        ->orderBy('created_at', 'desc')
        ->get(['id','title_en' , 'title_ar' , 'user_id', 'photo' ]);



        return DataTables::of($blog)

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

        $blog = Blog::create($request->except('photo','title_ar1','title_en1','description_ar1','description_en1',));
        if ($request->hasFile('photo')) {

            $blog->setImageAttribute([$request->file('photo'),'photo']);
            $blog->save();
        }

#############################BlogDescription#########################################

if (!empty($request->title_ar1)) {


    foreach ($request->title_ar1 as $key => $value) {


        BlogDescription::create([
            'blog_id'          => $blog->id,
            'title_ar'          => $request->title_ar1[ $key],
            'title_en'          => $request->title_en1[ $key],
            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End BlogDescription#########################################
        event(new SendMail($blog,'blog'));



    session()->flash('success', __('admin.Created Successfully'));
    return redirect()->route('blog.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest  $request,$id)
    {

//   return$request;

        $blog = Blog::findOrFail($id);
        $blog->update($request->except('photo','title_ar1','title_en1','description_ar1','description_en1',));
        if ($request->hasFile('photo')) {

            if ($blog->photo) {
                Storage::disk('blog')->delete($blog->photo);
            }
            $blog->setImageAttribute([$request->file('photo')]);
            $blog->save();
        }


#############################BlogDescription#########################################

if (!empty($request->title_ar1)) {

    BlogDescription::where('blog_id', $blog->id)->delete();
    foreach ($request->title_ar1 as $key => $value) {


        BlogDescription::create([
            'blog_id'          => $blog->id,
            'title_ar'          => $request->title_ar1[ $key],
            'title_en'          => $request->title_en1[ $key],
            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End BlogDescription#########################################







    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $blog = Blog::find($value);
    if ($blog->photo) {
        Storage::disk('blog')->delete($blog->photo);
    }
    $blog->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('blog.index');
    }
}

