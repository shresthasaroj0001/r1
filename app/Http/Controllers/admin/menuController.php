<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use DateTime;
use Validator;
use App\menu;
use Purifier;

class menuController extends Controller
{
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function index()
    {
        $responses = DB::select("SELECT id,title,DATE_FORMAT(menus.updated_at,'%Y-%b-%d') days,stats FROM menus WHERE menus.isdeleted=0 ORDER BY menus.orderb ASC");
        return view('admin.menu.index')->with('datas',$responses);
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function store (Request $request){
        $Validator = Validator::make($request->all(), [
            'title' => 'required',
            'itinerary' => 'required',
            'packageincludes' => 'required',
            'durationdetail' => 'required',
            'infos' => 'required',
            'stats' => 'required',
            'orderb' => 'required|numeric',
        ], []);

        if ($Validator->fails()) {
            return redirect()->back()->withInput($request->input())->withErrors($Validator);
        }

        $menus = new menu();
        $menus->title = $request->title;
        $menus->slug = $this->slugify($request->title);
        $menus->itinerary = Purifier::clean($request->itinerary);
        $menus->packageincludes = Purifier::clean($request->packageincludes);
        $menus->durationdetail = Purifier::clean($request->durationdetail);
        $menus->infos = Purifier::clean($request->infos);
        $menus->stats = $request->stats;
        $menus->parent_id = 0;
        $menus->isdeleted = 0;
        $menus->orderb = $request->orderb;
        $menus->save();

        return redirect()->route('trip.index')->with('success',"Menu added successfully");
    }

    public function show($id)
    {
        if($id > 0){
            $responses = DB::select('SELECT title,slug,itinerary,packageincludes,durationdetail,infos,parent_id,orderb,stats FROM menus WHERE menus.isdeleted=0 and menus.id=?',[$id]);
            if($responses != null) {
                $menus = new menu();
                $menus->id = $id;
                $menus->title = $responses[0]->title;
                $menus->slug = $responses[0]->slug;
                $menus->itinerary = $responses[0]->itinerary;
                $menus->packageincludes = $responses[0]->packageincludes;
                $menus->durationdetail = $responses[0]->durationdetail;
                $menus->infos = $responses[0]->infos;
                $menus->parent_id = $responses[0]->parent_id;
                $menus->orderb = $responses[0]->orderb;
                $menus->stats = $responses[0]->stats;
                return view('admin.menu.edit')->with('menu',$menus);
            }
        }else{
            return view('admin.404');
        }
    }

    public function edit($id){
        if($id > 0){
            $responses = DB::select('SELECT title,slug,itinerary,packageincludes,durationdetail,infos,parent_id,orderb,stats FROM menus WHERE menus.isdeleted=0 and menus.id=?',[$id]);
            if($responses != null) {
                $menus = new menu();
                $menus->id = $id;
                $menus->title = $responses[0]->title;
                $menus->slug = $responses[0]->slug;
                $menus->itinerary = $responses[0]->itinerary;
                $menus->packageincludes = $responses[0]->packageincludes;
                $menus->durationdetail = $responses[0]->durationdetail;
                $menus->infos = $responses[0]->infos;
                $menus->parent_id = $responses[0]->parent_id;
                $menus->orderb = $responses[0]->orderb;
                $menus->stats = $responses[0]->stats;
                return view('admin.menu.edit')->with('menu',$menus);
            }
        }else{
            return view('admin.404');
        }
    }

    public function update(Request $request, $id)
    {
        if ($id > 0) {
            $response = DB::select('SELECT stats FROM menus WHERE menus.isdeleted=0 and menus.id=?',[$id]);
            if ($response != null) {
                $Validator = Validator::make($request->all(), [
                    'title' => 'required',
                    'itinerary' => 'required',
                    'packageincludes' => 'required',
                    'durationdetail' => 'required',
                    'infos' => 'required',
                    'stats' => 'required',
                    'orderb' => 'required|numeric',
                ], []);
        
                if ($Validator->fails()) {
                    return redirect()->back()->withInput($request->input())->withErrors($Validator);
                }
        
                $menus = new menu();
                $menus->title = $request->title;
                $menus->slug = $this->slugify($request->title);
                $menus->itinerary = Purifier::clean($request->itinerary);
                $menus->packageincludes = Purifier::clean($request->packageincludes);
                $menus->durationdetail = Purifier::clean($request->durationdetail);
                $menus->infos = Purifier::clean($request->infos);
                $menus->stats = $request->stats;
                $menus->parent_id = 0;
                $menus->isdeleted = 0;
                $menus->orderb = $request->orderb;

                $rows= DB::update('update menus set title=?,slug=?,itinerary=?,packageincludes=?,durationdetail=?,infos=?,stats=?,parent_id=?,isdeleted=?,orderb=?,updated_at=? where id=?',[$menus->title,$menus->slug,$menus->itinerary,$menus->packageincludes,$menus->durationdetail,$menus->infos,$menus->stats,$menus->parent_id,$menus->isdeleted,$menus->orderb,new DateTime(),$id]);
                if($rows == 1)
                    return redirect()->route('trip.index')->with('success', 'Updated Successfully');
                return redirect()->route('trip.index')->with('error', 'Update Failed');
            }
        }
        return view('admin.404');
    }

    public function destroy($id)
    {
        if ($id > 0) {
            $response = DB::select('SELECT id FROM menus WHERE menus.isdeleted=0 AND menus.id=?', [$id]);
            if ($response != null) {
                $rows = DB::update("update menus set isdeleted=1,updated_at=? where id=?", [new DateTime(), $id]);
                // $rows = DB::update("update menus set isdeleted=1,authid=?,updated_at=? where id=?", [auth()->user()->id, new DateTime(), $id]);
                if ($rows == 1) {
                    return 1;
                }

            }
        }
        return 0;
    }

}
