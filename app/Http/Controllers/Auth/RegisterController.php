<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\UserModel;



class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function submit_add(Request $req){
        $all=$req->all();
        $ins = UserModel::create([
            "name" => $all['name'],
            "email" => $all['email'],
            "phone" => $all['phone'],
            "password" => bcrypt($all['password']),
      
        ]);
        if($ins){
            $message=['status'=>1,'message'=>'Insert User Success'];
        }else{
            $message=['status'=>0,'message'=>'Insert User Failed'];
        }
        return ($message);
    }


    
}
