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
        if(Auth::check()){
        $loginid = Auth::id();
        $profileData = DB::select('select username,mail,bio,images from users where id = '.$loginid);
        $dat['prof'] = (array)$profileData;
        $dat['selfprof'] = 1;
        $dat['following'] = 0;
        $dat['myId'] = Auth::id();
        //フォロワー数取得データ（共通）
        $counter = DB::select('select id from follows where following_id = '.Auth::id().'');
        $dat['follows']=count($counter);
        $counter = DB::select('select id from follows where followed_id = '.Auth::id().'');
        $dat['followed']=count($counter);
        #ヘッダー画像の読み込み
        $kariheaderimg = DB::select('select images from users where id = '.Auth::id().'');
        $arrheaderimg = (array)$kariheaderimg[0];
        $headerimg = $arrheaderimg["images"];
        $dat['headerimg']=$headerimg;
        #サイドバーの名前読込
        $mynamecls=DB::select('select username from users where id = '.Auth::id().'');
        $myname=(array)$mynamecls[0];
        $dat['myname']=$myname;


        //共通部分ここまで
        return view('users.profile',['userProfile'=>$dat]);
        }
        return view('auth.login');
    }
    public function update(Request $request){//ログイン中ユーザーのプロフィール編集（未完成）
        if(Auth::check()){
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
            bio=\''.$newData['newBio'].'\',
            images=\''.$newData['newIcon'].'\' where id ='.Auth::id().'');
            #ここから下は/profileと同じ内容
            //フォロワー数表示の機能
        $counter = DB::select('select id from follows where following_id = '.Auth::id().'');
        $dat['follows']=count($counter);
        $counter = DB::select('select id from follows where followed_id = '.Auth::id().'');
        $dat['followed']=count($counter);
        $loginid = Auth::id();
        $profileData = DB::select('select username,mail,bio,images from users where id = '.$loginid.'');
        $dat['prof'] = (array)$profileData;
        $dat['selfprof'] = 1;
        $dat['following'] = 0;
        $dat['myId'] = Auth::id();
        #ヘッダー画像の読み込み
        $kariheaderimg = DB::select('select images from users where id = '.Auth::id().'');
        $arrheaderimg = (array)$kariheaderimg[0];
        $headerimg = $arrheaderimg["images"];
        $dat['headerimg']=$headerimg;
        #サイドバーの名前読込
        $mynamecls=DB::select('select username from users where id = '.Auth::id().'');
        $myname=(array)$mynamecls[0];
        $dat['myname']=$myname;

        return view('users.profile',['userProfile'=>$dat]);
        }
        return view('auth.login');
    }
    public function search(Request $request){//検索機能部分
        if(Auth::check()){
    if($request->isMethod('post')){
        $myid = Auth::id();
        $searchName = $request->only('searchName');
        $searchdat = $searchName['searchName'];
        $result = DB::select('select id,images,username from users where username like "%'.$searchdat.'%" and id != '.$myid.'');
        }
        else{   //最初に検索ページ入ってきたときはこっち
            $searchdat="";
            $myid = Auth::id();
            $result = DB::select('select id,images,username from users where id != '.$myid.'');
        }
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
        ;//$followingnumbersにフォローしているidが入っている
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
        //フォロワー数表示の機能
        $counter = DB::select('select id from follows where following_id = '.Auth::id().'');
        $result['follows']=count($counter);
        $counter = DB::select('select id from follows where followed_id = '.Auth::id().'');
        $result['followed']=count($counter);
        #ヘッダー画像の読み込み
        $kariheaderimg = DB::select('select images from users where id = '.Auth::id().'');
        $arrheaderimg = (array)$kariheaderimg[0];
        $headerimg = $arrheaderimg["images"];
        $result['headerimg']=$headerimg;
        #サイドバーの名前読込
        $mynamecls=DB::select('select username from users where id = '.Auth::id().'');
        $myname=(array)$mynamecls[0];
        $result['myname']=$myname;


        return view('users.search',['searchResult' => $result]);
    }
        return view('auth.login');
    }}

    public function profileOther(Request $request){
        if(Auth::check()){
        $loginid = $request->only('id');
        $profileData = DB::select('select id,username,mail,bio,images from users where id = '.$loginid['id'].'');
        $postsData['prof'] = (array)$profileData;
        $postsData['selfprof'] = 0;
        $postsData['following'] = 0;
        $postsData['myId'] = Auth::id();

        if(Auth::id() == $loginid['id']){
            $postsData['following']=1;
        };
        $following = DB::select('select followed_id from follows where following_id = '.Auth::id().'' );
        foreach($following as $folobj){
            $folarr = (array)$folobj;
            $obj = DB::select('select id,user_id,post,created_at from posts where user_id = '.$loginid['id'].' order by created_at desc');
            foreach($obj as $usrposts){
                $posarr = (array)$usrposts;
                #画像ここから
                $imgkari = DB::select('select images from users where id = '.$posarr['user_id'].'');
                $imgexc=(array)$imgkari[0];
                $posarr['images'] =$imgexc['images'];
                #画像ここまで
                #名前ここから
                $namekari = DB::select('select username from users where id = '.$posarr['user_id'].'');//画像でーたを挿入
                $nameexc=(array)$namekari[0];
                $posarr['username'] =$nameexc['username'];
                #名前ここまで
                $postsData[] = $posarr;
            };
        };
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
        #サイドバーの名前読込
        $mynamecls=DB::select('select username from users where id = '.Auth::id().'');
        $myname=(array)$mynamecls[0];
        $postsData['myname']=$myname;


        return view('users.profile',['userProfile'=>$postsData]);
        }
        return view('auth.login');
    }

}
