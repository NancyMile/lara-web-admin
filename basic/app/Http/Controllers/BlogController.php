<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function allBlog()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.blog_all',compact('blog'));
    }

    public function addBlog()
    {
        $categories = BlogCategory::orderBy('category','ASC')->get();
        return view('admin.blog.blog_add',compact('categories'));
    }

    public  function storeBlog(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required',
            'title' => 'required',
            'image' => 'required',
            'description' => ''
        ],
        [
            'name.required' => 'Blog category is required',
            'title.required' => ' title is required',
        ]);

        //check image
        if($request->file('image'))
        {
            $image = $request->file('image');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(430,327)->save('upload/blog/'.$imageName);
            $imageUrl = 'upload/blog/'.$imageName;

            //find the blog
            Blog::insert([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
                'image' => $imageUrl,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Blog saved successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }
    }




}
