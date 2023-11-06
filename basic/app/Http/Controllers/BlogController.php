<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;

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



}
