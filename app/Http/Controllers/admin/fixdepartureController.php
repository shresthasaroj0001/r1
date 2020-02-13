<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DateTime;
use DB;
use Illuminate\Http\Request;

class fixdepartureController extends Controller
{
    public function showalltours()
    {
        $responses = DB::select("SELECT id,title,DATE_FORMAT(menus.updated_at,'%Y-%b-%d') days,infos as descriptions FROM menus WHERE menus.isdeleted=0 ORDER BY menus.orderb ASC");
        return view('admin.departure.allmenus')->with('datas', $responses);
    }

    public function index($id)
    {
        if ($id > 0) {
            $response = DB::select('SELECT menus.id,menus.title FROM menus WHERE menus.isdeleted=0 and menus.id=?', [$id]);
            if ($response != null) {
                return view('admin.departure.index')->with('menu_id', $id)->with('menu_title', $response[0]->title);
            }
        }
        return view('admin.404');
    }

    public function index_add($id)
    {
        if ($id > 0) {
            $response = DB::select('SELECT menus.id,menus.title FROM menus WHERE menus.isdeleted=0 and menus.id=?', [$id]);
            if ($response != null) {
                $feeNames = DB::select('select id,fee_names.grpLow,fee_names.grpHigh from fee_names ORDER BY id ASC');
                if ($response == null) {
                    return redirect()->route('admin.dashboard')->with('error', "Please contact developer");
                }

                return view('admin.departure.multipledeparture')->with('menu_id', $id)->with('menu_title', $response[0]->title)->with('feeNames', $feeNames);
            }
        } else {
            return view('admin.404');
        }
    }

    public function getcalenderData(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $menuId = $request->tId;

        try {
            $response = DB::select('call GetDataForCalenderIO(?,?,?)', array($menuId,$start,$end));
            return $response;
        } catch (\Illuminate\Database\QueryException $ex) {
             //dd($ex);
            return array();
        }
    }

    public function updateEventInfo(Request $request)
    {

        $events = $request->all();
        $now = new DateTime();
        $selectedDates = $events['selectedDates'];
        $TimeSelected = $events['TimeSelected'];

        try {
            $ids = [];
            DB::beginTransaction();

            foreach ($TimeSelected as $TimeOfDay) {
                foreach ($selectedDates as $eventDate) {
                    $temp = array(
                        'tourdetails_id' => $TimeOfDay['mId'],
                        'tourdatetime' => $eventDate . " " . $TimeOfDay['Time'],
                        'paxs' => 1,
                        'stats' => 1,
                        'created_at' => $now);
                    $id = DB::table('tourcalenderdatetimeinfos')->insertGetId($temp);
                    array_push($ids, $id);
                }
            }

            $ratesData = [];

            $index=0;
            foreach ($TimeSelected as $TimeOfDay) { 
                foreach ($selectedDates as $eventDate) { 
                    foreach ($TimeOfDay['ddata'] as $rate) { // 2pm 4pm 4
                        $temp = array(
                            'calenderId' => $ids[$index],
                            'feenameId' => $rate['id'],
                            'rates' => $rate['rates'],
                            'createdDate' => $now);
                        array_push($ratesData, $temp);
                    }
                  $index = $index+1;
                }
            }

            
            DB::table('fee_rates')->insert($ratesData);
            // dd($ids);
            DB::commit();
            return "1";
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            // return $ex;
            return "0";
        }
        return "0";
    }

}
