<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEnquiryFormMessage;
use App\Rules\GoogleRecaptcha;
use App\Rules\NoHtml;

class SendEnquiryController extends Controller
{
    //
    public function store(Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', new NoHtml],
            'email' => ['required', 'email', new NoHtml],
            'subject' => ['required', 'string', new NoHtml],
            'message' => ['required', 'string', new NoHtml],
            'g-recaptcha-response' => ['required', new GoogleRecaptcha]
        ]);
 
 
 
        // redirect to contact form with message
        session()->flash('success', 'Message is sent! We will get back to you soon!');
        Mail::send(new SendEnquiryFormMessage());
        return redirect()->back();
        
    }
}
