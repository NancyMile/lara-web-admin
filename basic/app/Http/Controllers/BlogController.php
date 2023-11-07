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

    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('category','ASC')->get();
        return view('admin.blog.blog_edit',compact('blog','categories'));
    }

    public function updateBlog(Request $request)
    {
        $blogId = $request->id;

        //check image
        if($request->file('image'))
        {
            $image = $request->file('image');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(430,327)->save('upload/blog/'.$imageName);
            $imageUrl = 'upload/blog/'.$imageName;

            //find blog to be updated
            Blog::find($blogId)->update([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
                'image' => $imageUrl,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Blog updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }else
        {
            Blog::find($blogId)->update([
                'blog_category_id' => $request->blog_category_id,
                'title' => $request->title,
                'description' => $request->description,
                'tags' => $request->tags,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Blog updated successfully, no image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog')->with($notification);
        }
    }

    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        unlink($blog->image);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function detailsBlog($id)
    {
        $allCategories = BlogCategory::orderBy('category','ASC')->limit(8)->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $blog = Blog::findOrFail($id);
        return view('frontend.blog',compact('blog','allBlogs','allCategories'));
    }

    public function categoryBlog($id)
    {
        $allCategories = BlogCategory::orderBy('category','ASC')->limit(8)->get();
        $allBlogs = Blog::latest()->limit(5)->get();
        $blogPost = Blog::Where('blog_category_id',$id)->orderBy('id','DESC')->get();
        $category = BlogCategory::findOrFail($id);
        return view('frontend.category_blog_details', compact('blogPost','allBlogs','allCategories','category'));
    }
}
