<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    public function followList(){
        if(Auth::check()){
        return view('follows.followList');
        }
        return view('auth.login');
    }
    public function followerList(){
        if(Auth::check()){
        return view('follows.followerList');
        }
        return view('auth.login');
    }

    public function follow(Request $request){
        if(Auth::check()){
        $idArr = $request->only('followId','loginId');
        $followId = (int)$idArr['followId'];
        $loginId = (int)$idArr['loginId'];
        //データ変換まではうまくできてる
        //array tostring がDB操作で出る
        DB::table('follows')->insertGetId(['followed_id'=>$followId,'following_id'=>$loginId]);
        //フォロワー数表示の機能
        $counter = DB::select('select id from follows where following_id = '.Auth::id().'');
        $postsData['follows']=count($counter);
        $counter = DB::select('select id from follows where followed_id = '.Auth::id().'');
        $postsData['followed']=count($counter);

            #ヘッダー画像の読み込み
        $kariheaderimg = DB::select('select images from users where id = '.Auth::id().'');
        $arrheaderimg = (array)$kariheaderimg[0];
        $headerimg = $arrheaderimg["images"];
        $postsData['headerimg']=$headerimg;

        return view('posts.index',['viewPosts'=>$postsData]);
        }
        return view('auth.login');
    }

    public function unfollow(Request $request){
        if(Auth::check()){
        $followId = $request->only('followId');
        $loginId = $request->only('loginId');
        DB::table('follows')->where([['followed_id',$followId],['following_id',$loginId]])->delete();
        //フォロワー数表示の機能
        $counter = DB::select('select id from follows where following_id = '.Auth::id().'');
        $postsData['follows']=count($counter);
        $counter = DB::select('select id from follows where followed_id = '.Auth::id().'');
        $postsData['followed']=count($counter);

        #ヘッダー画像の読み込み
        $kariheaderimg = DB::select('select images from users where id = '.Auth::id().'');
        $arrheaderimg = (array)$kariheaderimg[0];
        $headerimg = $arrheaderimg["images"];
        $postsData['headerimg']=$headerimg;

        return view('posts.index',['viewPosts'=>$postsData]);
        }
        return view('auth.login');
    }


}
