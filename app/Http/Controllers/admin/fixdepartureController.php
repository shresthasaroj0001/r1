<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\tourcalenderdatetimeinfo;
use DateTime;

class fixdepartureController extends Controller
{
    public function showalltours()
    {
        $responses = DB::select("SELECT id,title,DATE_FORMAT(menus.updated_at,'%Y-%b-%d') days,infos as descriptions FROM menus WHERE menus.isdeleted=0 ORDER BY menus.orderb ASC");
        return view('admin.departure.allmenus')->with('datas',$responses);
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
                return view('admin.departure.multipledeparture')->with('menu_id', $id)->with('menu_title', $response[0]->title);
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
        // return array();
        try {

            $responses = DB::select("SELECT tourcalenderdatetimeinfos.id, CONCAT('Rate Adult ',tourcalenderdatetimeinfos.rate_adult,'<br>','Rate Child',' ',tourcalenderdatetimeinfos.rate_children,'<br>','Seats ',tourcalenderdatetimeinfos.paxs,'<br> Updated ',DATE_FORMAT(tourcalenderdatetimeinfos.created_at, '%Y-%b-%d')) as description,DATE_FORMAT(tourcalenderdatetimeinfos.tourdatetime, '%h:%i %p') as title,DATE_FORMAT(tourcalenderdatetimeinfos.tourdatetime, '%Y-%m-%d') as start FROM tourcalenderdatetimeinfos INNER JOIN ( select distinct tourdatetime,max(id) ID from tourcalenderdatetimeinfos WHERE tourcalenderdatetimeinfos.tourdetails_id=? AND (tourcalenderdatetimeinfos.tourdatetime  BETWEEN ? AND ?) group by tourdatetime ) t1 ON                 tourcalenderdatetimeinfos.id=t1.ID ORDER BY tourcalenderdatetimeinfos.tourdatetime", [$menuId,$start, $end]);
            return $responses;
        } catch (\Illuminate\Database\QueryException $ex) {
            // dd($ex);
            return array();
        }
    }

    public function updateEventInfo(Request $request)
    {   
        $events = $request->all();
        $now = new DateTime();
        $data = array();
        foreach($events as $event){
            // $info = new tourcalenderdatetimeinfo();
            // $info->tourdatetime = $event['tourdatetime'];
            // $info->paxs = $event['paxs'];
            // $info->rate_children = $event['rate_children'];
            // $info->rate_adult = $event['rate_adult'];
            // $info->tourdetails_id = $event['tourdetails_id'];
            // $info->created_at = $now;
            // $info->stats = 1;
           $temp = array(
               'tourdatetime'=> $event['tourdatetime'], 
               'paxs'=> $event['paxs'], 
               'rate_children'=> $event['rate_children'], 
               'rate_adult'=> $event['rate_adult'], 
               'stats'=> 1, 
               'tourdetails_id'=> $event['tourdetails_id'], 
               'created_at'=> $now);
               array_push($data,$temp);
        }
        try {        
            DB::table('tourcalenderdatetimeinfos')->insert($data);
            return "1";
        } catch (\Illuminate\Database\QueryException $ex) {
            return $ex;
            return "0";
        }
        return "0";
    }

}
