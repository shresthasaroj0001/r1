<?php

namespace App\Jobs;

use App\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 1;
    public $tries = 1;

    // public $enquiryss;
    // public $childS;
    public $enquiryNo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($enquiryNo)
    {
        // $this->enquiryss = $enquiryss;
       $this->enquiryNo = $enquiryNo;
    }

    // public function __construct($enquiryNo)
    // {
    //     // $this->enquiryss = $enquiryss;
    //     $this->enquiryNo = $enquiryNo;
    // }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $resss = DB::select("select menus.title,fbookings.id,fbookings.firstname,fbookings.lastname,fbookings.mobilenos,fbookings.alt_mobilenos,fbookings.email,fbookings.additionalinfo,fee_names.grpLow,fee_names.grpHigh,fee_rates.rates,DATE_FORMAT(tourcalenderdatetimeinfos.tourdatetime,'%Y-%b-%d %h:%i %p') as tourdate from fbookings inner join fee_rates on fbookings.calenderId=fee_rates.id inner join tourcalenderdatetimeinfos on fee_rates.calenderId=tourcalenderdatetimeinfos.id inner join menus on tourcalenderdatetimeinfos.tourdetails_id=menus.id inner join fee_names on fee_rates.feenameId=fee_names.id where fbookings.id=?",[$this->enquiryNo]);

        $data = array(
            'from_email' => $resss[0]->email,
            'title' => $resss[0]->title,
            'from_name' => $resss[0]->firstname . ' ' . $resss[0]->lastname,
            'to_name' => 'Admin',
            'subject' => 'New Booking',
            'to_email' => 'sher@shellytours.com',
            'mobilenos' => $resss[0]->mobilenos,
            'alt_mobilenos' => $resss[0]->alt_mobilenos == null ? '' : $resss[0]->alt_mobilenos,
            'additionalinfo' => $resss[0]->additionalinfo,
            'tourdate' => $resss[0]->tourdate,
            'grpSize' => 'Group '.$resss[0]->grpLow.' - '.$resss[0]->grpHigh,
            'ratess' => $resss[0]->rates,
        );

        Mail::send('test', $data, function ($m) use ($data) {
            $m->from($data['from_email'], $data['from_name']);
            $m->to($data['to_email'], $data['to_name'])->subject($data['subject']);
        });
    }
}
