<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){//ログイン中ユーザーのプロフィールページへ
        $loginid = Auth::id();
        $profileData = DB::select('select username,mail,bio,images from users where id = '.$loginid);
        return view('users.profile',['userProfile'=>$profileData]);
    }
    public function update(Request $request){//ログイン中ユーザーのプロフィール編集（未完成）
        return view('users.profile');
    }
    public function search(Request $request){//検索機能部分
        $searchName = $request->only('searchName');
        $searchdat = $searchName['searchName'];
        $result = DB::select('select id,images,username from users where username like "%'.$searchdat.'%"');
        $checkerCnt = 1;
        foreach($result as $followCheckerObj){
            $followCheckerArr = (array)$followCheckerObj;
            if($checkerCnt == 0){
                $followChecked =array($followCheckerArr['']);
            };
        };
        //$searchViewData =['searchResult'=>$result,'searchWord'=>$searchdat];
        $result[] = $searchdat;
        return view('users.search',['searchResult' => $result]);
    }
    public function index(){
        return view('users.search');
    }
}
