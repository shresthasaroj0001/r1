<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;

class SendEnquiryFormMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        return $this->from([
            'address' => $request->email, 
            'name' => $request->name 
        ])
        ->to( env('APP_ADMIN_CONTACT') )
        ->subject( 'Message from website: ' . $request->subject )
        ->view('emails.contactform')
        ->with([    
            'contactName' => $request->name,
            'contactSubject' => $request->subject,
            'contactEmail' => $request->email,
            'contactMessage' => $request->message
        ]);
    }
}
