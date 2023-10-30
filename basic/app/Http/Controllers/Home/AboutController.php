<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    public function aboutPage()
    {
        $aboutPage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutPage'));
    }

    public function updateAbout(Request $request)
    {
        $aboutId = $request->id;

        //check image
        if($request->file('aboutImage'))
        {
            $image = $request->file('aboutImage');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(523,605)->save('upload/home_about/'.$imageName);
            $imageUrl = 'upload/home_about/'.$imageName;

            //find the slide to be updated
            About::find($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->shortTitle,
                'short_description' => $request->shortDescription,
                'long_description' => $request->longDescription,
                'about_image' => $imageUrl,
            ]);
            $notification = array(
                'message' => 'About updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else
        {
            About::find($aboutId)->update([
                'title' => $request->title,
                'short_title' => $request->shortTitle,
                'short_description' => $request->shortDescription,
                'long_description' => $request->longDescription,
            ]);
            $notification = array(
                'message' => 'About updated successfully, no image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
