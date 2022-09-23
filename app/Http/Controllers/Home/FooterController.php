<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{

    public function footerSetup(){

        $footerpage = Footer::find(1);
        return view('admin.footer.footer_all', compact('footerpage'));

    }

    public function updateFooter(Request $request){

        $footer_id = $request->id;

        Footer::findOrFail($footer_id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'address' => $request->address,
            'email' => $request->email,
            'instagram' => $request->instagram,
            'copyright' => $request->copyright,

        ]);

        $notification = array(
            'message' => 'Footer Page Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

}
