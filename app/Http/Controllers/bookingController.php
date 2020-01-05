<?php



namespace App\Http\Controllers;



use App\Enquiry;

use DateTime;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

use Validator;

use Illuminate\Support\Facades\Mail;
use App\Jobs\SendMailJob;
use Carbon\Carbon;

class bookingController extends Controller

{

    public function store(Request $request)

    {
 $validator = Validator::make($request->all(), [
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

        $enquiryss = new Enquiry();
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

        $tempo = "";
        if (!(is_null($varres))) {
            $sql = "SELECT GROUP_CONCAT(child_seats.name SEPARATOR ' , ') as name FROM enquirychildseats INNER JOIN child_seats ON enquirychildseats.childSeatid=child_seats.id where enquirychildseats.enquiryno=".$enquiryss->id;
            $res = DB::select($sql);
            if ($res == null) {
            } else {
                $tempo = $res[0]->name;
            }
        }

        $data = array('from_email' => $enquiryss->email, 'from_name' => $enquiryss->firstname . ' ' . $enquiryss->lastname,
            'to_name' => 'Admin', 'subject' => 'New Enquiry', 'to_email' => 'admin@shellytours', 'mobilenos' => $enquiryss->mobilenos, 'alt_mobilenos' => $enquiryss->alt_mobilenos == null ? '' : $enquiryss->alt_mobilenos, 'cruiseterminal' => $enquiryss->cruiseterminal, 'airport' => $enquiryss->airport, 'other' => $enquiryss->other,
            'triptype' => $enquiryss->triptype,
            'traveldate' => $enquiryss->traveldate,
            'pickupaddress' => $enquiryss->pickupaddress,
            'noofpassenger' => $enquiryss->noofpassenger,
            'flightinfo' => $enquiryss->flightinfo,
            'privatecharter' => $enquiryss->privatecharter == 1 ? 'Yes' : 'No',
            'additionalinfo' => $enquiryss->additionalinfo
        );

        $job = (new SendMailJob($enquiryss,$tempo))->delay(Carbon::now()->addSeconds(3));
        dispatch($job);

        // try
        // {
        //     Mail::send('test', $data, function ($m) use ($data) {
        //         $m->from($data['from_email'], $data['from_name']);
        //         $m->to($data['to_email'], $data['to_name'])->subject($data['subject']);
        //     });

        // } catch (\Exception $e) {
        //     dd($e);
        //     return redirect()->back()->with('error', 'Failed.');
        // }

        return redirect()->back()->with('success', 'We will reply you very soon');
    }

}

