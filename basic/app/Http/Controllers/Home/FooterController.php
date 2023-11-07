<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function footerSetup()
    {
        $footer = Footer::find(1);
        return view('admin.footer.footer_all',compact('footer'));
    }
    public function updateFooter(Request $request)
    {
        $footerId = $request->id;
        //find the footer to be updated
        Footer::find($footerId)->update([
            'phone' => $request->phone,
            'description' => $request->description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copy_right' => $request->copy_right,

        ]);
        $notification = array(
            'message' => 'Footer updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
