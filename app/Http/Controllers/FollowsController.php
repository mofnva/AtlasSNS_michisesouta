<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

    public function follow(Request $request){
        $idArr = $request->only('followId','loginId');
        $followId = (int)$idArr['followId'];
        $loginId = (int)$idArr['loginId'];
        //データ変換まではうまくできてる
        //array tostring がDB操作で出る
        DB::table('follows')->insertGetId(['followed_id'=>$followId,'following_id'=>$loginId]);
        return view('users.search');
    }

    public function unfollow(Request $request){
        $followId = $request->only('followId');
        $loginId = $request->only('loginId');
        DB::table('follows')->where([['followed_id',$followId],['following_id',$loginId]])->delete();
        return view('users.search');
    }


}
