<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PostsController extends Controller
{
    //
    public function index(Request $request){
        if($request->isMethod('post')){
            $txtdat =  $request->only('postText');
            DB::table('posts')->insertGetId(['user_id'=>auth::id(),
            'post'=>$txtdat['postText']]);
        }
        return view('posts.index');
    }
}
