<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    public function homeMain()
    {
        return view('frontend.index');
    }

    public function homeSlider()
    {
        $homeSlide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeSlide'));
    }

    public function updateSlider(Request $request)
    {
        $slideId = $request->id;

        //check image
        if($request->file('homeSlide'))
        {
            $image = $request->file('homeSlide');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(636,852)->save('upload/home_slider/'.$imageName);
            $imageUrl = 'upload/home_slider/'.$imageName;

            //find the slide to be updated
            HomeSlide::find($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->shortTitle,
                'video_url' => $request->videoUrl,
                'home_slide' => $imageUrl,
            ]);
            $notification = array(
                'message' => 'Slider updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else
        {
            HomeSlide::find($slideId)->update([
                'title' => $request->title,
                'short_title' => $request->shortTitle,
                'video_url' => $request->videoUrl,
            ]);
            $notification = array(
                'message' => 'Slider updated successfully, no image',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
