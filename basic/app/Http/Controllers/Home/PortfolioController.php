<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Porfolio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function allPortfolio()
    {
        $portfolio = Porfolio::latest()->get();
        return view('admin.portfolio.portfolio_all',compact('portfolio'));
    }
    //add portfolio
    public function addPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public  function storePortfolio(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'image' => 'required',
            'description' => ''
        ],
        [
            'name.required' => 'Portfolio name is required',
            'title.required' => 'Portfolio title is required',
        ]);

        //check image
        if($request->file('image'))
        {
            $image = $request->file('image');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(1020,519)->save('upload/portfolio/'.$imageName);
            $imageUrl = 'upload/portfolio/'.$imageName;

            //find the portfolio
            Porfolio::insert([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageUrl,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Portfolio saved successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }
    }

    public function editPortfolio($id)
    {
        $portfolio = Porfolio::findOrFail($id);
        return view('admin.portfolio.portfolio_edit',compact('portfolio'));
    }

    public function updatePortfolio(request $request)
    {
        $portfolioId = $request->id;

        //check image
        if($request->file('image'))
        {
            $image = $request->file('image');
            //generate new name
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            //resize image to 636 x 852
            Image::make($image)->resize(636,852)->save('upload/portfolio/'.$imageName);
            $imageUrl = 'upload/portfolio/'.$imageName;

            //find the slide to be updated
            Porfolio::find($portfolioId)->update([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imageUrl,
            ]);
            $notification = array(
                'message' => 'Portfolio updated successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }else
        {
            Porfolio::find($portfolioId)->update([
                'name' => $request->name,
                'title' => $request->title,
                'description' => $request->description,
            ]);
            $notification = array(
                'message' => 'Portfolio updated successfully, no image',
                'alert-type' => 'success'
            );
            return redirect()->route('all.portfolio')->with($notification);
        }
    }
}
