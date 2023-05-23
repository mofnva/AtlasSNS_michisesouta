<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(Request $request){//検索機能部分
        $searchName = $request->only('searchName');
        $searchdat = $searchName['searchName'];
        $result = DB::select('select images,username from users where username like "%'.$searchdat.'%"');
        //$searchViewData =['searchResult'=>$result,'s\earchWord'=>$searchdat];
        //$resultobj = $result[0];
        //$resultarr = (array)$resultobj;
        return view('users.search',['searchResult' => $result]);
    }
    public function index(){
        return view('users.search');
    }
}
