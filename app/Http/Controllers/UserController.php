<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\RoleModel;


class UserController extends Controller
{

    public function index(){

        $users = UserModel::with(['role','department'])->get();
        return view('user.index', compact('users')); 
    }

    
    public function add(){
        $department=DepartmentModel::all();
        $role=RoleModel::all();
        return view('user.action.add',['department'=>$department,'role'=>$role]);
    }


    public function submit_add(Request $req){
        $all=$req->all();
        $ins = UserModel::create([
            "name" => $all['name'],
            "gender" => $all['gender'],
            "dob" => $all['dob'],
            "email" => $all['email'],
            "phone" => $all['phone'],
            "password" => bcrypt($all['password']),
            "department_id" => $all['department'],
            "role_id" => $all['role'],
        ]);
        if($ins){
            $message=['status'=>1,'message'=>'Insert User Success'];
        }else{
            $message=['status'=>0,'message'=>'Insert User Failed'];
        }
        return ($message);
    }

    public function edit($user_id){
        $user=UserModel::find($user_id);
        $department=DepartmentModel::all();
        $role=RoleModel::all();
        return view('user.action.edit',['user'=>$user,'department'=>$department,'role'=>$role]);
    }
    public function update(Request $req){
        $all=$req->all();
        $user=UserModel::find($all['user_id']);
        $user->name=$all['name'];
        $user->gender=$all['gender'];
        $user->dob=$all['dob'];
        $user->email=$all['email'];
        $user->phone=$all['phone'];
        if(isset($all['password'])){
            $user->password=bcrypt($all['password']);
        }
        $user->department_id=$all['department'];
        $user->role_id=$all['role'];
        $upd=$user->save();
        if($upd){
            $message=['status'=>1,'message'=>'Edit User Success'];
        }else{
            $message=['status'=>0,'message'=>'Edit User Failed'];
        }
        return ($message);
    }
    public function destroy($user_id){
        $user = UserModel::find($user_id);
        if ($user) {
            $user->delete();
            $message=['status'=>1,'message'=>'Delete User Success'];
        }else{
            $message=['status'=>0,'message'=>'Delete User Failed'];
        }
        return ($message);
    }
   


    
}
