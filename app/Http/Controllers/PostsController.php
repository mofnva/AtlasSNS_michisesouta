<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    //
    public function index(Request $request){
        if($request->isMethod('post')){//投稿処理
            $txtdat =  $request->only('postText');
            DB::table('posts')->insertGetId(['user_id'=>auth::id(),
            'post'=>$txtdat['postText']]);
        }//投稿処理ここまで
        //表示する投稿データの送信処理(
        $postsData = array();
        $following = DB::select('select followed_id from follows where following_id = '.Auth::id().'' );
        foreach($following as $folobj){
            $folarr = (array)$folobj;
            $obj = DB::select('select id,user_id,post,created_at from posts where user_id = '.$folarr['followed_id'].' order by created_at desc');
            foreach($obj as $usrposts){
                $posarr = (array)$usrposts;
                $postsData[] = $posarr;

            };
        };
        return view('posts.index',['viewPosts'=>$postsData]);
        //表示データ送信ここまで
    }
    public function delete(Request $request){
        $deleteId = (int)
        $request['deleteId'];
        DB::table('posts')->where('id',$deleteId)->delete();
        //var_dump($deleteId);

        $postsData = DB::select('select id,user_id,post,created_at from posts order by created_at desc');//フォロー機能ができたらここの条件を変える
        return view('posts.index',['viewPosts'=>$postsData]);
    }

    public function followlist(Request $request){
        //表示する投稿データの送信処理
        $postsData = array();
        $profImages = array();
        $following = DB::select('select followed_id from follows where following_id = '.Auth::id().'' );
        foreach($following as $folobj){
            $folarr = (array)$folobj;
            $obj = DB::select('select id,user_id,post,created_at from posts where user_id = '.$folarr['followed_id'].' order by created_at desc');
            foreach($obj as $usrposts){
                $posarr = (array)$usrposts;
                $postsData[] = $posarr;
            };
            $imgobj = DB::select('select images,id from users where id = '.$folarr['followed_id'].'');
            $imgarr = (array)$imgobj;
            $profImages[] = $imgarr;
        };
        $postsData[] = $profImages;
        return view('follows.followlist',['viewPosts'=>$postsData]);
        //表示データ送信ここまで
    }

    public function followerlist(Request $request){
        //表示する投稿データの送信処理
        $postsData = array();
        $profImages = array();
        $following = DB::select('select following_id from follows where followed_id = '.Auth::id().'' );
        foreach($following as $folobj){
            $folarr = (array)$folobj;
            $obj = DB::select('select id,user_id,post,created_at from posts where user_id = '.$folarr['following_id'].' order by created_at desc');
            foreach($obj as $usrposts){
                $posarr = (array)$usrposts;
                $postsData[] = $posarr;
            };
            $imgobj = DB::select('select images,id from users where id = '.$folarr['following_id'].'');
            $imgarr = (array)$imgobj;
            $profImages[] = $imgarr;
        };
        $postsData[] = $profImages;
        return view('follows.followerlist',['viewPosts'=>$postsData]);
        //表示データ送信ここまで
    }


}
