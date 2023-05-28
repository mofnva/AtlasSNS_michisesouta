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
        //表示する投稿データの送信処理(フォロー機能未実装のため全ユーザー表示で仮作成)
        $postsData = DB::select('select id,user_id,post,created_at from posts order by created_at desc');//フォロー機能ができたらここの条件を変える
        return view('posts.index',['viewPosts'=>$postsData]);
        //表示データ送信ここまで
    }
    public function delete(Request $request){
        $deleteId = (int)
        $request['deleteId'];
        DB::table('posts')->where('id',$deleteId)->delete();
        var_dump($deleteId);

        $postsData = DB::select('select id,user_id,post,created_at from posts order by created_at desc');//フォロー機能ができたらここの条件を変える
        return view('posts.index',['viewPosts'=>$postsData]);
    }
}
