<?php

namespace App\Http\Controllers\admin;

use App\gallery;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use DateTime;
use Validator;

class galleryController extends Controller
{

    public function index($id)
    {
        $responses = DB::select("SELECT id,title FROM menus WHERE menus.isdeleted=0 ORDER BY menus.orderb ASC");
        if ($responses != null) {
            return view('admin.gallery.index')->with('menu_id', $id)->with('menu_title', $responses[0]->title);
        }
        return view('admin.404');
    }

    public function store(Request $request, $id)
    {
        if ($id > 0) {
            // $responses = DB::select("SELECT menus.id FROM menus WHERE menus.isdeleted=0 and menus.id=?", $id);
            // if ($responses != null) {
            if ($request->hasFile('file')) {
                // Get jst ext
                $extension = $request->file('file')->getClientOriginalExtension();
                $filesize = $request->file('file')->getClientSize();
                // if ($filesize > 11534336) {
                //     return redirect()->back()->withInput($request->input())->with('error', 'Please select file less than 11MB');
                // }
                if (
                    (strcasecmp($extension, 'png') == 0) ||
                    (strcasecmp($extension, 'jpg') == 0) ||
                    (strcasecmp($extension, 'bmp') == 0) ||
                    (strcasecmp($extension, 'jpeg') == 0) ||
                    (strcasecmp($extension, 'gif') == 0)
                ) {
                    //Filename to store
                    $fileNameToStore = "" . time() . '.' . $extension;
                    //uplod image
                    $file = $request->file('file');
                    $destinationPath = public_path('/uploads/');
                    $file->move($destinationPath, $fileNameToStore);

                    $counters = DB::select("SELECT COUNT(galleries.id) as cnt from galleries WHERE galleries.isdeleted=0 and galleries.menu_id=?", [$id]);
                    $gallllery = new gallery();
                    $gallllery->menu_id = $id;
                    $gallllery->title = $fileNameToStore;
                    $gallllery->isfeatureimg = 0;
                    $gallllery->stats = 1;
                    $gallllery->orderb = (int) $counters[0]->cnt + 1;
                    $gallllery->isdeleted = 0;
                    $gallllery->save();

                    $json_data = array(
                        "isSuccess" => true,
                        "datas" => array(
                            "id" => $gallllery->id,
                            "title" => $gallllery->title,
                            "isfeatureimg" => 0,
                            "stats" => 1,
                            "orderb" => $gallllery->orderb,
                        ),
                    );
                    return $json_data;
                }
                //}
            }
        }
        $json_data = array(
            "isSuccess" => false,
            "title" => "",
        );
        return $json_data;
    }

    public function getPicsForAjax($id)
    {
        if ($id > 0) {
            $response = DB::select("SELECT galleries.id,galleries.title,galleries.isfeatureimg,galleries.stats,galleries.orderb from galleries WHERE galleries.isdeleted=0 and galleries.menu_id=? ORDER BY galleries.orderb ASC", [$id]);
            return $response;
        }
        return array();
    }

    public function update(Request $request, $id, $galId)
    {
        $Validator = Validator::make($request->all(), [
            'isfeatureimg' => 'required|numeric',
            'stats' => 'required|numeric',
            'orderb' => 'required|numeric',
        ], []);

        if ($Validator->fails()) {
            return 0;
        }

        if ((int) $id > 0 && (int) $galId > 0) {
            $rows = DB::update("select title from galleries where id=? and menu_id=?",[$galId,$id]);
            if($rows == null){
                return 0;
            }
            $gallerya = new gallery();
            $gallerya->menu_id = $id;
            $gallerya->id = $galId;
            $gallerya->isfeatureimg = $request->isfeatureimg;
            $gallerya->stats = $request->stats;
            $gallerya->orderb = $request->orderb;
            $rows = DB::update("update galleries set isfeatureimg=?,stats=?,orderb=?,updated_at=? where id=? and menu_id=?",[$gallerya->isfeatureimg,$gallerya->stats,$gallerya->orderb, new DateTime(),$gallerya->id,$gallerya->menu_id]);
            if($rows==1){
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }


    public function destroy($id, $galId)
    {
        $rows = DB::select("select title from galleries where id=? and menu_id=?",[$galId,$id]);
        if($rows != null){
            $row = DB::update("update galleries set isdeleted=?,updated_at=? where id=? and menu_id=?",[1, new DateTime(),$galId,$id]);
            if($row==1){
                return 1;
            }
        }
        return 0;
    }
}
