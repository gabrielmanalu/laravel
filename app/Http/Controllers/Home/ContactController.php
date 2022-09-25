<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function contactMe(){
        $allMultiImage = MultiImage::latest()->limit(3)->get();
        return view('frontend.contact', compact('allMultiImage'));
    }

    public function storeMessage(Request $request){

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Message Submitted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function contactMessage(){
        $contact = Contact::latest()->get();
        return view('admin.contact.message', compact('contact'));
    }

    public function deleteMessage($id){
        Contact::findorFail($id)->delete();
        $notification = array(
            'message' => 'Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
