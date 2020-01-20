<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Enquiry;
use Illuminate\Support\Facades\Mail;

class SendServiceMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 1;
    public $tries = 1;

    public $enquiryss;
    public $childS;

    public function __construct(Enquiry $enquiryss, $childS)
    {
        $this->enquiryss = $enquiryss;
        $this->childS = $childS;
    }

    public function handle()
    {
        $data = array();
        $data = array('from_email' => $this->enquiryss->email, 'from_name' => $this->enquiryss->firstname . ' ' . $this->enquiryss->lastname,
            'to_name' => 'Admin', 'subject' => 'New Enquiry', 'to_email' => 'sher@shellytours.com', 'mobilenos' => $this->enquiryss->mobilenos, 'alt_mobilenos' => $this->enquiryss->alt_mobilenos == null ? '' : $this->enquiryss->alt_mobilenos, 'cruiseterminal' => $this->enquiryss->cruiseterminal, 'airport' => $this->enquiryss->airport, 'other' => $this->enquiryss->other,
            'triptype' => $this->enquiryss->triptype,
            'traveldate' => $this->enquiryss->traveldate,
            'pickupaddress' => $this->enquiryss->pickupaddress,
            'noofpassenger' => $this->enquiryss->noofpassenger,
            'flightinfo' => $this->enquiryss->flightinfo,
            'privatecharter' => $this->enquiryss->privatecharter == 1 ? 'Yes' : 'No',
            'additionalinfo' => $this->enquiryss->additionalinfo, 'childseats' => $this->childS,
        );

        Mail::send('servicemail', $data, function ($m) use ($data) {
            $m->from($data['from_email'], $data['from_name']);
            $m->to($data['to_email'], $data['to_name'])->subject($data['subject']);
        });
    }
}
