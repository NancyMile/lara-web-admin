<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function allBlogCategory()
    {
        $blog = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all',compact('blog'));
    }

    public function addBlogCategory()
    {
        return view('admin.blog_category.blog_category_add');
    }

    public function storeBlogCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            ],
        [
            'name.required' => 'Blog Category name is required',
        ]);

            //save
            BlogCategory::insert([
                'category' => $request->name,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Blog Category saved successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.category')->with($notification);
    }
}
