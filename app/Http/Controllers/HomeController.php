<?php

namespace App\Http\Controllers;

use App\fbooking;
use App\payments;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Payment;
use Validator;
use Session;

class homeController extends Controller
{

    public function index()
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
                //geting most recent date of event
                $res= DB::select("select date_format(t1.tourdatetime , '%Y-%m-%d') datess from ( select tourdatetime,max(id) as maxId,stats from tourcalenderdatetimeinfos where date_format(tourcalenderdatetimeinfos.tourdatetime , '%Y-%m-%d') >= CURRENT_DATE() and tourcalenderdatetimeinfos.tourdetails_id=? group by tourcalenderdatetimeinfos.tourdatetime,stats order by tourdatetime ) t1 where t1.stats=1 limit 1",[$tours[0]->id]);
                $dates = "";
                if (!(empty($res[0]->datess))) {
                    $dates = $res[0]->datess;
                }
                return view('front/tour/sydney')->with('dates',$dates)->with('activevar', 'tours')->with('tour', $tours)->with('galleries', $galleries)->with('email', "");
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

            return redirect('/tourssssssss')->with('email', "");
        }

        $ids = $request->redirectFrmId;
        $adults = $request->redirectFrmadults;
        $childs = $request->redirectFrmchilds;

        return view('front.tour.fbooking')->with('ids', $ids)->with('adults', $adults)->with('childs', $childs)->with('activevar', 'tours');
    }

    public function saveBooking(Request $request)
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
            
            'additionalinfo' => 'max:190',
        ], [
            "firstname.required" => trans('Full Name is required'),
        ]);

        if ($validator->fails()) {
            // return $validator;
            // return redirect('/tourssssssss')->with('email', "");

            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $enquiryss = new fbooking();
        // $enquiryss->calenderId = $res[0]-    >id;
        $enquiryss->calenderId = $request->calId;
        $enquiryss->adults = $request->adults;
        $enquiryss->childs = $request->childs;
        
        $enquiryss->firstname = $request->firstname;
        $enquiryss->lastname = $request->lastname;
        $enquiryss->mobilenos = $request->mobilenos;
        $enquiryss->alt_mobilenos = $request->alt_mobilenos;
        $enquiryss->email = $request->email;
        
        $enquiryss->additionalinfo = $request->additionalinfo == null ? "" :$request->additionalinfo;
        // $enquiryss->save();
        $datess = new DateTime();
        $idss = DB::table('fbookings')->insertGetId(
            [ 
            'calenderId' => $enquiryss->calenderId, 'adults' => $enquiryss->adults, 'childs' => $enquiryss->childs, 'firstname' => $enquiryss->firstname, 'lastname' => $enquiryss->lastname, 'mobilenos' => $enquiryss->mobilenos, 'alt_mobilenos' => $enquiryss->alt_mobilenos, 'email' => $enquiryss->email, 'additionalinfo' => $enquiryss->additionalinfo, 'created_at' => $datess, 'updated_at'=>$datess
            ]
        );

        $job = (new SendMailJob($idss))->delay(Carbon::now()->addSeconds(3));
        // $job = (new SendMailJob($enquiryss, $tempo))->delay(Carbon::now()->addSeconds(3));
        dispatch($job);

        //return redirect('/tours')->with('email', "$enquiryss->email");
        //return redirect()->route('payment.redirect',[$enquiryss->id]);
    //     $this->RedirectToPays($enquiryss->id);
    // }

    // public function RedirectToPays($enqId)
    //{
        $enqId = $idss;
        $ress = DB::select('call testprocedure(?)', [$enqId]);
        // dd($ress);
        if ($ress != null) {

            $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    'AUJin7vEgSZlC8O0UrSX8I_ERDJ0fzTVh06KylfamRKhYZ1QLcpYA8oHO2JtgW1vfsMVNKU367T4wID8', // ClientID
                    'EMfaRm6NPn-t71p1IHg_W05GK3ZOsUguHPHLssAU-LuoKW7XdVihg3XneXOP0RB3myAIC2ylQXIQfyld' // ClientSecret
                )
            );

            $payer = new \PayPal\Api\Payer();
            $payer->setPaymentMethod('paypal');

            $itemList = new \PayPal\Api\ItemList();
            $temparray=array();
            if ($ress[0]->adults > 0) {
                $item1 = new \PayPal\Api\Item();
                $item1->setName('Adult')
                    ->setCurrency('AUD')
                    ->setQuantity($ress[0]->adults)
                    ->setSku($ress[0]->calenderId)
                    ->setPrice($ress[0]->rate_adult);
                    array_push($temparray,$item1);
                // $itemList->setItems(array($item1));
            }

            if ($ress[0]->childs > 0) {
                $item2 = new \PayPal\Api\Item();
                $item2->setName('Children')
                    ->setCurrency('AUD')
                    ->setQuantity($ress[0]->childs)
                    ->setSku($ress[0]->calenderId) // Similar to `item_number` in Classic API
                    ->setPrice($ress[0]->rate_children);
                    array_push($temparray,$item2);

                // $itemList->setItems(array($item2));
            }
            $itemList->setItems($temparray);
            $totalamt = 0;
            $totalamt = ($ress[0]->adults * $ress[0]->rate_adult) + ($ress[0]->childs * $ress[0]->rate_children);

            $details = new \PayPal\Api\Details();
             $details->setShipping(0)
                ->setTax(0)
                ->setSubtotal($totalamt);
            
            $amount = new \PayPal\Api\Amount();
            $amount->setCurrency("AUD")
                ->setTotal($totalamt)
                ->setDetails($details);
            $transaction = new \PayPal\Api\Transaction();
            // $transaction->setAmount($amount);
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription($ress[0]->title . " " . $ress[0]->tourdate)
                // ->setInvoiceNumber("R".$enqId);
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
                Session::put('id', $enqId);
                $approvalUrl = $payment->getApprovalLink();

                return redirect($approvalUrl);
                // dd($payment);

                //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            } catch (\PayPal\Exception\PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
               // echo $ex;
                
               // echo $ex->getData();
               dd($ex->getData());
               die($ex);
            }
            return redirect('/')->with('activevar', 'tours')->with('msg', 'Error while storing data');
        }else{
        //   dd($ress);
        return redirect('/tours')->with('activevar', 'tours')->with('msg', 'Error while storing datas');  
        }
    }

    public function executepayment()
    {
        $ids = Session::get('id');
        $ress = DB::select('call testprocedure(?)', [$ids]);

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AUJin7vEgSZlC8O0UrSX8I_ERDJ0fzTVh06KylfamRKhYZ1QLcpYA8oHO2JtgW1vfsMVNKU367T4wID8', // ClientID
                'EMfaRm6NPn-t71p1IHg_W05GK3ZOsUguHPHLssAU-LuoKW7XdVihg3XneXOP0RB3myAIC2ylQXIQfyld' // ClientSecret
            )
        );
        $paymenId = request('paymentId');
        $payment = Payment::get($paymenId, $apiContext);

        $execution = new \PayPal\Api\PaymentExecution();
        // $execution->setPayerId($_GET['PayerID']);
        $execution->setPayerId(request('PayerID'));

        $transaction = new \PayPal\Api\Transaction();
        $amount = new \PayPal\Api\Amount();
        $details = new \PayPal\Api\Details();
        $details->setShipping(0)
           ->setTax(0)
           ->setSubtotal(($ress[0]->adults * $ress[0]->rate_adult) + ($ress[0]->childs * $ress[0]->rate_children));

        $amount->setCurrency('AUD');
        $amount->setTotal(($ress[0]->adults * $ress[0]->rate_adult) + ($ress[0]->childs * $ress[0]->rate_children));
        $amount->setDetails($details);
        $transaction->setAmount($amount);

        $execution->addTransaction($transaction);

        try {
            $result = $payment->execute($execution, $apiContext);

            $payments = new \App\payment();
            $payments->enq_id =$ids;
            $payments->payId =$result->id;
            $payments->status =$result->state;
            $payments->save();

            return redirect('/tours')->with('activevar', 'tours')->with('msg',"Thank You for booking");
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            //ResultPrinter::printError("Executed Payment", "Payment", null, null, $ex);
           dd($ex->getData());
               die($ex);
        }
        //ResultPrinter::printResult("Get Payment", "Payment", $payment->getId(), null, $payment);

        //return $result;
        return redirect('/tours')->with('activevar', 'tours')->with('msg',"Something Went Wrong");
        //http://localhost:8000/execute-payment?paymentId=PAYID-LYNJYJA4MB03793X2896534C&token=EC-0LB962779N900710S&PayerID=25R3LCAZHK63U
    }
}
