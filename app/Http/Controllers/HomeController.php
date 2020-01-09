<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DateTime;
use Validator;

class HomeController extends Controller
{
    
    public function index(Request $request)
    {
        $response = DB::Select("select m.title,m.slug,m.infos, IFNUll(c.title,'') as featureimg from menus as m  left join ( select galleries.title,galleries.menu_id from galleries where isfeatureimg=1 and isdeleted=0 and stats=1 group by menu_id,title having max(updated_at))  c on m.id =c.menu_id ORDER BY m.orderb ASC");
        return $response;
    }
}
