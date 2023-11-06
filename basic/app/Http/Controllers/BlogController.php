<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function allBlog()
    {
        $blog = Blog::latest()->get();
        return view('admin.blog.blog_all',compact('blog'));
    }

}
