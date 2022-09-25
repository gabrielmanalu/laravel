<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManagerStatic as Image;

class PortfolioController extends Controller
{

    public function portfolio(){

        $portfolio = Portfolio::latest()->get();
        $allMultiImage = MultiImage::latest()->limit(3)->get();
        return view('frontend.portfolio', compact('portfolio', 'allMultiImage'));
    }

    public function allPortfolio(){

        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function addPortfolio(){

        return view('admin.portfolio.portfolio_add');
    }

    public function storePortfolio(Request $request){

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required'
        ], [
            'portfolio_name.required' => 'Portfolio Name is Required',
            'portfolio_title.required' => 'Portfolio Title is Required',
            'portfolio_image.required' => 'Portfolio Image is Required'
        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        Image::make($image)->resize(1020,519)->save('upload/portfolio_images/'.$name_gen);
        $save_url = 'upload/portfolio_images/'.$name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_description' => $request->portfolio_description,
            'portfolio_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Portfolio Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);

    }


    public function editPortfolio($id){

        $portfolio = Portfolio::findorFail($id);
        return view('admin.portfolio.edit_portfolio', compact('portfolio'));
    }

    public function updatePortfolio(Request $request){

        $portfolio_id = $request->id;

        if($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(1020,519)->save('upload/portfolio_images/'.$name_gen);
            $save_url = 'upload/portfolio_images/'.$name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);

        }else {

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);

        }

    }

    public function deletePortfolio($id){

        $portfolio = Portfolio::findorFail($id);
        $image = $portfolio->portfolio_image;
        unlink($image);

        Portfolio::findorFail($id)->delete();

        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


    public function detailPortfolio($id){

        $portfolio = Portfolio::findorFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));

    }
}
