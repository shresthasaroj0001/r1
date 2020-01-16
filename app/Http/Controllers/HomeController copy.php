<?php

namespace App\Http\Controllers;

use App\Enquiry;
use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Validator;

class HomeControllers extends Controller
{
    public function home()
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUJin7vEgSZlC8O0UrSX8I_ERDJ0fzTVh06KylfamRKhYZ1QLcpYA8oHO2JtgW1vfsMVNKU367T4wID8', // ClientID
                'EMfaRm6NPn-t71p1IHg_W05GK3ZOsUguHPHLssAU-LuoKW7XdVihg3XneXOP0RB3myAIC2ylQXIQfyld' // ClientSecret
            )
        );

        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new \PayPal\Api\Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(10)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice(10);
        $item2 = new \PayPal\Api\Item();
        $item2->setName('Granola bars')
            ->setCurrency('USD')
            ->setQuantity(5)
            ->setSku("321321") // Similar to `item_number` in Classic API
            ->setPrice(10);

        $itemList = new \PayPal\Api\ItemList();
        $itemList->setItems(array($item1, $item2));

        $details = new \PayPal\Api\Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal(150);

        $amount = new \PayPal\Api\Amount();
        $amount->setCurrency("USD")
            ->setTotal(150)
            ->setDetails($details);

        $transaction = new \PayPal\Api\Transaction();
        // $transaction->setAmount($amount);
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/execute-payment")
            ->setCancelUrl("http://localhost:8000/cancel");

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        // After Step 3
        try {
            $payment->create($apiContext);
            // dd($payment);

            //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }

        return redirect($payment->getApprovalLink());
        // $approvalUrl = $payment->getApprovalLink();

        // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

        // return $payment;
    }

    public function executepayment(Request $request)
    {
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        if ($request->has('paymentId')) {
            $paymenId = $request->input('paymentId');

            $execution = new \PayPal\Api\PaymentExecution();
            if ($request->has('PayerID')) {
                $execution->setPayerId = $request->input('PayerID');

                $transaction = new \PayPal\Api\Transaction();
                $details = new \PayPal\Api\Details();
                $details->setShipping(0)
                    ->setTax(0)
                    ->setSubtotal(150);

                $amount = new \PayPal\Api\Amount();
                $amount->setCurrency("USD")
                    ->setTotal(150)
                    ->setDetails($details);

                $transaction->setAmount($amount);

                $execution->addTransaction($transaction);
                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        'AUJin7vEgSZlC8O0UrSX8I_ERDJ0fzTVh06KylfamRKhYZ1QLcpYA8oHO2JtgW1vfsMVNKU367T4wID8', // ClientID
                        'EMfaRm6NPn-t71p1IHg_W05GK3ZOsUguHPHLssAU-LuoKW7XdVihg3XneXOP0RB3myAIC2ylQXIQfyld' // ClientSecret
                    )
                );
                $redirectUrls = new \PayPal\Api\RedirectUrls();
                $redirectUrls->setReturnUrl("http://localhost:8000/execute-payment")
                    ->setCancelUrl("http://localhost:8000/cancel");

                $payment = new \PayPal\Api\Payment();
                $payment->setIntent('sale')
                    ->setPayer($payer)
                    ->setTransactions(array($transaction))
                    ->setRedirectUrls($redirectUrls);
                $result = $payment->execute($execution, $apiContext);
                return $result;
            }
        }

        # code...
        // dd($request);
        return redirect('/tours');
        //http://localhost:8000/execute-payment?paymentId=PAYID-LYNJYJA4MB03793X2896534C&token=EC-0LB962779N900710S&PayerID=25R3LCAZHK63U
    }

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
                return view('front/tour/sydney')->with('activevar', 'tours')->with('tour', $tours)->with('galleries', $galleries)->with('email', "");
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

            return redirect('/tours')->with('email', "");
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

        return redirect('/tours')->with('email', "$enquiryss->email");
    }

    //     return redirect()->back()->with('error', 'Booking Is Full');

    //     }
    //     return redirect()->back()->with('error', 'Tour Package Not Found');
    // }    

}
