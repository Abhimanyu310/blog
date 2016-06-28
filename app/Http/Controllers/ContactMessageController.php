<?php

namespace App\Http\Controllers;

use App\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{

    public function getContactIndex()
    {
        return view('frontend.other.contact');
    }

    public function postSendMessage(Request $request){

        $this->validate($request, [
           'email' => 'required|email',
            'name' => 'required|max:100',
            'subject' => 'required|max:140',
            'message' => 'required|min:10'
        ]);


        $message = new ContactMessage();
        $message->email = $request['email'];
        $message->sender = $request['name'];
        $message->subject = $request['subject'];
        $message->body = $request['message'];
        $message->save();
        return redirect()->route('contact')->with(['success' => 'Message Successfully sent!']);
    }
}