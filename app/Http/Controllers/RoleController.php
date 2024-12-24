<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\PermissionRoleModel;


class RoleController extends Controller
{
    public function index(){
        $role=RoleModel::all();
        return view('role.index',compact('role')); 
    }
    public function add(){
        return view('role.action.add');
    }
    public function submit_add(Request $req){
        $all=$req->all();
        $ins = RoleModel::create([
            "name" => $all['name']
        ]);
        if($ins){
            $message=['status'=>1,'message'=>'Insert Role Success'];
        }else{
            $message=['status'=>0,'message'=>'Insert Role Failed'];
        }
        return ($message);
    }

    public function edit($role_id){
        $role=RoleModel::find($role_id);
        return view('role.action.edit',['role'=>$role]);
    }
    public function update(Request $req){
        $all=$req->all();
        $role=RoleModel::find($all['role_id']);
        $role->name=$all['name'];
        $upd=$role->save();
        if($upd){
            $message=['status'=>1,'message'=>'Edit Role Success'];
        }else{
            $message=['status'=>0,'message'=>'Edit Role Failed'];
        }
        return ($message);
    }
    public function destroy($role_id){
        $role = RoleModel::find($role_id);
        if ($role) {
            $role->delete();
            $message=['status'=>1,'message'=>'Delete Role Success'];
        }else{
            $message=['status'=>0,'message'=>'Delete Role Failed'];
        }
        return ($message);
    }

    public function set_permission_role($role_id){
        $permission=PermissionModel::all();
        $permission_role = PermissionRoleModel::select('permission_id')->where('role_id',$role_id)->get();
        return view('role.action.set_permission',['role_id'=>$role_id,'permission'=>$permission,'permission_role'=>$permission_role]); 
    }
    public function submit_set_permission_role(Request $req){
        $all=$req->all();
        $del_role_permission=PermissionRoleModel::find($all['role_id']);
        if($del_role_permission){
            $del_role_permission->delete();
        }
        $role_permission_data=[];
        foreach ($all['permission_id'] as $p_id) {
            $role_permission_data[]=[
                'role_id'=>$all['role_id'],
                'permission_id'=>$p_id
            ];
        }
        $ins=PermissionRoleModel::insert($role_permission_data);
        if ($ins) {
            $message=['status'=>1,'message'=>'Set Permission To Role Success'];
        }else{
            $message=['status'=>0,'message'=>'Set Permission To Role Failed'];
        }
        return ($message);
        
    }
}
