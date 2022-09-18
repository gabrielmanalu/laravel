<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\ImageManagerStatic as Image;


class AboutController extends Controller
{
    public function aboutPage(){
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutpage'));
    }

    public function updateAbout(Request $request){

        $about_id = $request->id;

        if($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(523,605)->save('upload/about_images/'.$name_gen);
            $save_url = 'upload/about_images/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url
            ]);

            $notification = array(
                'message' => 'About Page UpdatedSuccessfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } else {

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description
            ]);

            $notification = array(
                'message' => 'About Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }

    }

    public function homeAbout(){
        $aboutpage = About::find(1);
        return view('frontend.about_page', compact('aboutpage'));
    }
}
