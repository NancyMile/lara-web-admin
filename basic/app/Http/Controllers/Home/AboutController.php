<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;
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

    //frontend about
    public  function homeAbout()
    {
        $aboutPage = About::find(1);
        return view('frontend.about_page',compact('aboutPage'));
    }

    //frontend about multiImages
    public function aboutMultiImage()
    {
        return view('admin.about_page.multiImage');
    }

    //admin store multi images
    public function storeMultiImages(Request $request)
    {
        $image = $request->file('multiImage');

        foreach ($image as $multiImage) {
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$multiImage->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($multiImage)->resize(220,220)->save('upload/multi/'.$imageName);
            $imageUrl = 'upload/home_about/'.$imageName;

            //insert images
            MultiImage::insert([
                'multi_image' => $imageUrl,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Images saved successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
