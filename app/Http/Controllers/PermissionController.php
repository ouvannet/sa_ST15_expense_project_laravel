<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionModel;


class PermissionController extends Controller
{
    public function index(){
        $permission=PermissionModel::all();
        return view('permission.index',compact('permission')); 
    }
    public function add(){
        return view('permission.action.add');
    }
    public function submit_add(Request $req){
        $all=$req->all();
        $ins = PermissionModel::create([
            "name" => $all['name']
        ]);
        if($ins){
            $message=['status'=>1,'message'=>'Insert Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Insert Permission Failed'];
        }
        return ($message);
    }

    public function edit($permission_id){
        $permission=PermissionModel::find($permission_id);
        return view('permission.action.edit',['permission'=>$permission]);
    }
    public function update(Request $req){
        $all=$req->all();
        $permission=PermissionModel::find($all['permission_id']);
        $permission->name=$all['name'];
        $upd=$permission->save();
        if($upd){
            $message=['status'=>1,'message'=>'Edit Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Edit Permission Failed'];
        }
        return ($message);
    }
    public function destroy($permission_id){
        $permission = PermissionModel::find($permission_id);
        if ($permission) {
            $permission->delete();
            $message=['status'=>1,'message'=>'Delete Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Delete Permission Failed'];
        }
        return ($message);
    }
}
