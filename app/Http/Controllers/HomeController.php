<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Enquiry;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $response = DB::Select("select m.title,m.slug,m.infos, IFNUll(c.title,'') as featureimg from menus as m  left join ( select galleries.title,galleries.menu_id from galleries where isfeatureimg=1 and isdeleted=0 and stats=1 group by menu_id,title having max(updated_at))  c on m.id =c.menu_id ORDER BY m.orderb ASC");
        return $response;
    }

    public function gettourdetail($tourname)
    {
        if (!(empty($tourname))) {
            $tours = DB::select("select menus.id, menus.title, menus.slug, menus.itinerary,menus.packageincludes,menus.durationdetail,menus.infos,
            IFNULL(( select galleries.title from galleries where isfeatureimg=1 and isdeleted=0 and stats=1 and menu_id=menus.id group by menu_id,title having max(updated_at) ), '') featureImg from menus where lower(menus.slug)=lower(?) and menus.isdeleted=0", [$tourname]);
            if ($tours != null) {
                $galleries = DB::select("SELECT galleries.title,galleries.isfeatureimg from galleries WHERE galleries.isdeleted=0 and galleries.stats=1 and galleries.isfeatureimg=0 and galleries.menu_id=? ORDER by galleries.orderb", [$tours[0]->id]);
                return view('front/tour/sydney')->with('activevar', 'tours')->with('tour', $tours)->with('galleries', $galleries)->with('email',"");
            }
        }
        return view('404');
    }

    public function onDateSelected(Request $request)
    {
        try {
            $tourId = (int) $request->pid;
        } catch (\Exception $e) {
            dd($e);
            return array();
        }

        $dateSelected = $request->month;
        $d = DateTime::createFromFormat('Y-m-d', $dateSelected);
        if (!$d) {
            return array();
        }
        $finaldate = $d->format('Y-m-d');
        if (!$finaldate) {
            return array();
        }

        //productid
        //day
        $response = DB::select('call GetAvailabilityForGivenDate(?,?)', array($tourId, $finaldate));

        $returnarray = array();
        if ($response != null) {
            foreach ($response as $tour) {
                if ((int) $tour->stats == 1) {
                    $var = (object) [
                        'rate_child' => $tour->rate_children,
                        'rate_adult' => $tour->rate_adult,
                        'paxs' => (int) $tour->paxs - (int) $tour->cnt,
                        'tourdatetime' => $tour->tourdatetime,
                        'ids' => $tour->id,
                    ];
                    array_push($returnarray, $var);
                }
            }
        }
        return $returnarray;
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
        // return $d && $d->format($format) == $date;
    }

    public function getMonthChange(Request $request)
    {
        //productid
        //month starting
        try {
            $tourId = (int) $request->pid;
        } catch (\Exception $e) {
            dd($e);
            return array();
        }

        $dateSelected = $request->month;
        $d = DateTime::createFromFormat('Y-m-d', $dateSelected);
        if (!$d) {
            return array();
        }
        // $ds = $d->format('Y-m-d');
        // dd($ds);
        // $res= $this->validateDate($dateSelected);
        // if(!$res){
        //     dd($res);
        //     return array();
        // }
        $finaldate = $d->format('Y-m-d');
        if (!$finaldate) {
            return array();
        }

        // $response = DB::select('call GetAvailability()');
        $response = DB::select('call GetAvailabiltyForMonth(?,?)', array($tourId, $finaldate));
        if ($response == null) {
            return array();
        }
        return $response;
    }

    public function booknowRedirect(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'redirectFrmId' => 'required',
            'redirectFrmadults' => 'required',
            'redirectFrmchilds' => 'required',
        ], []);

        if ($Validator->fails()) {
            // dd($Validator);

            return redirect('/tours')->with('email',"");
        }

        $ids = $request->redirectFrmId;
        $adults = $request->redirectFrmadults;
        $childs = $request->redirectFrmchilds;

        return view('front.tour.fbooking')->with('ids', $ids)->with('adults', $adults)->with('childs', $childs)->with('activevar', 'tours');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'calId' => 'required',
            'adults' => 'required',
            'childs' => 'required',

            'firstname' => 'required|max:190',
            'lastname' => 'required|max:190',
            'mobilenos' => 'required|max:190',
            'altmobilenumber' => 'max:190',
            'email' => 'required|email|max:190',
            'cruiseterminal' => 'required',
            'airport' => 'required',

            'triptype' => 'required|max:190',
            // 'traveldatetime' => 'required|date|date_format:Y-m-d H:i:s',
            'traveldatetime' => 'required',
            'pickupaddress' => 'required|string|min:3|max:255',
            "noofpassenger" => "required|numeric|not_in:''|min:1|max:2",
            'flightinfo' => 'required|max:190',
            'privatecharter' => 'required|boolean',
            'additionalinfo' => 'max:190',
            // "additionalinfo" => "required|not_in:''|min:1|max:2"
        ], [
            "firstname.required" => trans('Full Name is required'),
        ]);

        // $table->string('mobilenos');
        // $table->string('alt_mobilenos')->nullable();
        // $table->string('email');
        // $table->string('cruiseterminal')->nullable();
        // $table->string('airport')->nullable();
        // $table->string('other');
        // $table->string('triptype');
        // $table->date('traveldate');
        // $table->date('pickupaddress');
        // $table->integer('noofpassenger');
        // $table->string('flightinfo');
        // $table->boolean('privatecharter');
        // $table->string('additionalinfo');

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        //$res = DB::select("SELECT tour.id,tour.paxs,tour.rate_children,tour.rate_adult,tour.stats from tourcalenderdatetimeinfos as tour WHERE tour.tourdatetime=(SELECT tourcalenderdatetimeinfos.tourdatetime from tourcalenderdatetimeinfos WHERE tourcalenderdatetimeinfos.id=?) HAVING MAX(tour.created_at)",[$request->calId]);
        //if($res != null){
        // dd($res);
        // if( ($request->adults)+($request->childs) <= $res[0]->paxs){
        // if($res[0]->id != $request->calId)
        // {
        //     // rate id is changed
        //     return redirect()->back()->with('error', 'Tour Details is changed.. Please try again.');
        // }

        $enquiryss = new Enquiry();
        // $enquiryss->calenderId = $res[0]-    >id;
        $enquiryss->calenderId = $request->calId;
        $enquiryss->adults = $request->adults;
        $enquiryss->childs = $request->childs;

        $enquiryss->firstname = $request->firstname;
        $enquiryss->lastname = $request->lastname;
        $enquiryss->mobilenos = $request->mobilenos;
        $enquiryss->alt_mobilenos = $request->alt_mobilenos;
        $enquiryss->email = $request->email;
        $enquiryss->other = $request->other;
        $enquiryss->cruiseterminal = $request->cruiseterminal;
        $enquiryss->airport = $request->airport;

        $enquiryss->other = $request->other;

        $enquiryss->triptype = $request->triptype;
        $enquiryss->traveldate = $request->traveldatetime;
        $enquiryss->pickupaddress = $request->pickupaddress;
        $enquiryss->noofpassenger = $request->noofpassenger;
        $enquiryss->flightinfo = $request->flightinfo;
        $enquiryss->privatecharter = $request->privatecharter;
        $enquiryss->additionalinfo = $request->additionalinfo;
        $varres = Input::get('childseats');
        DB::beginTransaction();
        $enquiryss->save();

        if (!(is_null($varres))) {
            $data = array();
            foreach ($varres as $value) {
                $tempModel = array('enquiryno' => $enquiryss->id, 'childSeatid' => $value, 'created_at' => new DateTime(), 'updated_at' => new DateTime());
                array_push($data, $tempModel);
            }
            DB::table('enquirychildseats')->insert($data);
        }

        DB::commit();

        // $tempo = "";
        // if (!(is_null($varres))) {
        //     $sql = "SELECT GROUP_CONCAT(child_seats.name SEPARATOR ' , ') as name FROM enquirychildseats INNER JOIN child_seats ON enquirychildseats.childSeatid=child_seats.id where enquirychildseats.enquiryno=" . $enquiryss->id;
        //     $res = DB::select($sql);
        //     if ($res == null) {
        //     } else {
        //         $tempo = $res[0]->name;
        //     }
        // }

        // $data = array('from_email' => $enquiryss->email, 
        // 'from_name' => $enquiryss->firstname . ' ' . $enquiryss->lastname,
        //     'to_name' => 'Admin', 
        //     'subject' => 'New Enquiry', 
        //     'to_email' => 'admin@shellytours', 
        //     'mobilenos' => $enquiryss->mobilenos, 
        //     'alt_mobilenos' => $enquiryss->alt_mobilenos == null ? '' : $enquiryss->alt_mobilenos, 
        //     'cruiseterminal' => $enquiryss->cruiseterminal, 
        //     'airport' => $enquiryss->airport, 
        //     'other' => $enquiryss->other,
        //     'triptype' => $enquiryss->triptype,
        //     'traveldate' => $enquiryss->traveldate,
        //     'pickupaddress' => $enquiryss->pickupaddress,
        //     'noofpassenger' => $enquiryss->noofpassenger,
        //     'flightinfo' => $enquiryss->flightinfo,
        //     'privatecharter' => $enquiryss->privatecharter == 1 ? 'Yes' : 'No',
        //     'additionalinfo' => $enquiryss->additionalinfo,
        // );

        $job = (new SendMailJob($enquiryss->id))->delay(Carbon::now()->addSeconds(3));
        // $job = (new SendMailJob($enquiryss, $tempo))->delay(Carbon::now()->addSeconds(3));
        dispatch($job);

        return redirect('/tours')->with('email',"$enquiryss->email");
    }

    //     return redirect()->back()->with('error', 'Booking Is Full');

    //     }
    //     return redirect()->back()->with('error', 'Tour Package Not Found');
    // }

}
