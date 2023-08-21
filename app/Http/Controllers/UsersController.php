<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function profile(){//ログイン中ユーザーのプロフィールページへ
        $loginid = Auth::id();
        $profileData = DB::select('select username,mail,bio,images from users where id = '.$loginid);
        $dat['prof'] = (array)$profileData;
        $dat['selfprof'] = 1;
        $dat['following'] = 0;
        $dat['myId'] = Auth::id();
        return view('users.profile',['userProfile'=>$dat]);
    }
    public function update(Request $request){//ログイン中ユーザーのプロフィール編集（未完成）
        $newData = $request->only('newUsername','newMail','newPassword','newPassword-confirmation','newBio','newIcon');
            $request->validate([
                'newPassword'=>['confirmed']
            ]);
        $pass =DB::select('select password from users where id ='.Auth::id().'');
        #データを書き換える部分
            $kari=DB::update('update users set
            username=\''.$newData['newUsername'].'\',
            mail=\''.$newData['newMail'].'\',
            password=\''.bcrypt($newData['newPassword']).'\',
            bio=\''.$newData['newBio'].'\'
             where id ='.Auth::id().'');
            #ここから下は/profileと同じ内容
        $loginid = Auth::id();
        $profileData = DB::select('select username,mail,bio,images from users where id = '.$loginid);
        $dat['prof'] = (array)$profileData;
        $dat['selfprof'] = 1;
        $dat['following'] = 0;
        $dat['myId'] = Auth::id();
        return view('users.profile',['userProfile'=>$dat]);
    }
    public function search(Request $request){//検索機能部分
        $searchName = $request->only('searchName');
        $searchdat = $searchName['searchName'];
        $result = DB::select('select id,images,username from users where username like "%'.$searchdat.'%"');
        $checkerCnt = 0;
        //フォロー中のユーザーを配列化
        $followingobj = DB::select(
            'select id,followed_id from follows where following_id ='.Auth::id().' '
        );
        $followingnumbers = array();
        $followings = array();
        foreach($followingobj as $followid){
            $followingArr = (array)$followid;
            $followingnumbers[] = $followingArr['followed_id'];
        };//$followingnumbersにフォローしているidが入っている
        //フォローチェック機構
        foreach($result as $followCheckerObj){//検索一時結果を配列化
            $followCheckerArr = (array)$followCheckerObj;
            $follow=0;
            foreach($followingnumbers as $numbercheck){//検索一時結果をフォローしているか判別
                if($numbercheck == $followCheckerArr['id']){
                    $follow = 1;
                };//フォローしていれば$follow=1
            };
            $followings[] = $follow;//結果を$followingsに収納
        };
        //$searchViewData =['searchResult'=>$result,'searchWord'=>$searchdat];
        $result[] = $searchdat;
        $result[] = $followings;
        return view('users.search',['searchResult' => $result]);
    }
    public function index(){
        return view('users.search');
    }

    public function profileOther(Request $request){
        $loginid = $request->only('id');
        $profileData = DB::select('select id,username,mail,bio,images from users where id = '.$loginid['id'].'');
        $dat['prof'] = (array)$profileData;
        $dat['selfprof'] = 0;
        $dat['following'] = 0;
        if(Auth::id() == $loginid['id']){
            $dat['following']=1;
        };
            $obj = DB::select('select id,user_id,post,created_at from posts where user_id = '.$loginid['id'].' order by created_at desc');
            $posarr = (array)$obj;
        $dat['posts'] = $posarr;
        $dat['myId'] = Auth::id();
        return view('users.profile',['userProfile'=>$dat]);
    }

}
