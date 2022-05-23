<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Post;

class AdminController extends Controller
{
    function login(){
    	return view('admin.login');
    }
    function submit_login(Request $request){
    	$request->validate([
    		'username'=>'required',
    		'password'=>'required'
    	]);

    	$userCheck=Admin::where(['username'=>$request->username,'password'=>$request->password])->count();
    	if($userCheck>0){
            $adminData=Admin::where(['username'=>$request->username,'password'=>$request->password])->first();
            session(['adminData'=>$adminData]);
    		return redirect('admin/dashboard');
    	}else{
    		return redirect('admin/login')->with('error','Kullanıcı adı veya şifre hatalı!!');
    	}

    }
    function dashboard(){
        $posts=Post::orderBy('id','desc')->get();
    	return view('admin.dashboard',['posts'=>$posts]);
    }
    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }
}
