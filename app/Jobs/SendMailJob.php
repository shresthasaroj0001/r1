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
        //$resss = DB::select("select calenderId, adults, childs, firstname, lastname, mobilenos, alt_mobilenos, email, cruiseterminal, airport, other, triptype,DATE_FORMAT(traveldate,'%Y-%b-%d %h:%i %p') as traveldate, pickupaddress, noofpassenger, flightinfo, privatecharter, additionalinfo, DATE_FORMAT(tourdatetime,'%Y-%b-%d %h:%i %p') as tourdate, rate_children, rate_adult, ( SELECT GROUP_CONCAT(child_seats.name SEPARATOR ' , ') FROM enquirychildseats INNER JOIN child_seats ON enquirychildseats.childSeatid=child_seats.id where enquirychildseats.enquiryno=enquiries.id) ts from enquiries INNER JOIN tourcalenderdatetimeinfos on enquiries.calenderId=tourcalenderdatetimeinfos.id WHERE enquiries.id=?", [1]);
        $resss = DB::select('call testprocedure(?)',[$this->enquiryNo]);

        $Enquirys = new Enquiry();

        $Enquirys->calenderId = $resss[0]->calenderId;
        $Enquirys->adults = $resss[0]->adults;
        $Enquirys->childs = $resss[0]->childs;
        $Enquirys->firstname = $resss[0]->firstname;
        $Enquirys->lastname = $resss[0]->lastname;
        $Enquirys->mobilenos = $resss[0]->mobilenos;
        $Enquirys->alt_mobilenos = $resss[0]->alt_mobilenos;
        $Enquirys->email = $resss[0]->email;
        $Enquirys->cruiseterminal = $resss[0]->cruiseterminal;
        $Enquirys->airport = $resss[0]->airport;
        $Enquirys->other = $resss[0]->other;
        $Enquirys->triptype = $resss[0]->triptype;
        $Enquirys->traveldate = $resss[0]->traveldate;
        $Enquirys->pickupaddress = $resss[0]->pickupaddress;
        $Enquirys->noofpassenger = $resss[0]->noofpassenger;
        $Enquirys->flightinfo = $resss[0]->flightinfo;
        $Enquirys->privatecharter = $resss[0]->privatecharter;
        $Enquirys->additionalinfo = $resss[0]->additionalinfo;
        $Enquirys->tourdate = $resss[0]->tourdate;
        $Enquirys->rate_children = $resss[0]->rate_children;
        $Enquirys->rate_adult = $resss[0]->rate_adult;
        $Enquirys->ts = $resss[0]->ts;
        $Enquirys->title = $resss[0]->title;

        // return $this->from($enquiryss)
        //         ->name('New Guest Mail')
        //         ->view('test')->with('$enquiryss',$enquiryss);
        // 'adults' => $Enquirys->adults,
        //     'childs' => $Enquirys->childs,
        //     'rate_children' => $Enquirys->rate_children,
        //     'rate_adult' => $Enquirys->rate_adult,

        $chidtotal =  $Enquirys->childs * $Enquirys->rate_children;
        $adulttotols = $Enquirys->adults * $Enquirys->rate_adult;
        $finalTotals = $chidtotal+$adulttotols;

        $data = array();
        $data = array(
            'from_email' => $Enquirys->email,
            'title' => $Enquirys->title,
            'from_name' => $Enquirys->firstname . ' ' . $Enquirys->lastname,
            'to_name' => 'Admin',
            'subject' => 'New Booking',
            'to_email' => 'sher@shellytours.com',
            'mobilenos' => $Enquirys->mobilenos,
            'alt_mobilenos' => $Enquirys->alt_mobilenos == null ? '' : $Enquirys->alt_mobilenos,
            'cruiseterminal' => $Enquirys->cruiseterminal,
            'airport' => $Enquirys->airport,
            'other' => $Enquirys->other,
            'triptype' => $Enquirys->triptype,
            'traveldate' => $Enquirys->traveldate,
            'pickupaddress' => $Enquirys->pickupaddress,
            'noofpassenger' => $Enquirys->noofpassenger,
            'flightinfo' => $Enquirys->flightinfo,
            'privatecharter' => $Enquirys->privatecharter == 1 ? 'Yes' : 'No',
            'additionalinfo' => $Enquirys->additionalinfo,
            'childseats' => $Enquirys->ts,
            'tourdate' => $Enquirys->tourdate,
            'adults' => $Enquirys->adults,
            'childs' => $Enquirys->childs,
            'rate_children' => $Enquirys->rate_children,
            'rate_adult' => $Enquirys->rate_adult,
            'childtotal' => $chidtotal,
            'adulttotal' => $adulttotols,
            'finalTotals' => $finalTotals
        );

        Mail::send('test', $data, function ($m) use ($data) {
            $m->from($data['from_email'], $data['from_name']);
            $m->to($data['to_email'], $data['to_name'])->subject($data['subject']);
        });
    }
}
