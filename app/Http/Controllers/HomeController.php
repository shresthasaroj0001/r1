<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

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
                $galleries = DB::select("SELECT galleries.title,galleries.isfeatureimg from galleries WHERE galleries.isdeleted=0 and galleries.stats=0 and galleries.isfeatureimg=0 and galleries.menu_id=? ORDER by galleries.orderb", [$tours[0]->id]);
                return view('front/tour/sydney')->with('activevar', 'tours')->with('tour', $tours)->with('galleries', $galleries);
            }
        }
        return view('404');
    }
}