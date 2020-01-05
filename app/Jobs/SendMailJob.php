<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Enquiry;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMailable;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 1;
    public $tries = 1;

    public $enquiryss;
    public $childS;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiryss,$childS)
    {
        $this->enquiryss = $enquiryss;
        $this->childS = $childS;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // return $this->from($enquiryss)
        //         ->name('New Guest Mail')
        //         ->view('test')->with('$enquiryss',$enquiryss);

        $data = array();
        $data = array('from_email' => $this->enquiryss->email, 'from_name' => $this->enquiryss->firstname . ' ' . $this->enquiryss->lastname,
            'to_name' => 'Admin', 'subject' => 'New Enquiry', 'to_email' => 'sher@shellytours.com', 'mobilenos' => $this->enquiryss->mobilenos, 'alt_mobilenos' => $this->enquiryss->alt_mobilenos == null ? '' : $this->enquiryss->alt_mobilenos, 'cruiseterminal' => $this->enquiryss->cruiseterminal, 'airport' => $this->enquiryss->airport, 'other' => $this->enquiryss->other,
            'triptype' => $this->enquiryss->triptype,
            'traveldate' => $this->enquiryss->traveldate,
            'pickupaddress' => $this->enquiryss->pickupaddress,
            'noofpassenger' => $this->enquiryss->noofpassenger,
            'flightinfo' => $this->enquiryss->flightinfo,
            'privatecharter' => $this->enquiryss->privatecharter == 1 ? 'Yes' : 'No',
            'additionalinfo' => $this->enquiryss->additionalinfo, 'childseats'=>$this->childS
        );  

        //Mail::to('abc@a.com')->send(new TestMailable());
//'childseats'=>'tempo'
        // return $data;    

        Mail::send('test', $data, function ($m) use ($data) {
            $m->from($data['from_email'], $data['from_name']);
            $m->to($data['to_email'], $data['to_name'])->subject($data['subject']);
        });
    }
}
