<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\DepartmentModel;


class DepartmentController extends Controller
{

    public function index()
    {
        $departments = DepartmentModel::all();
        return view('department.index', compact('departments'));
    }


    public function add(Request $request)
    {
        return view('department.action.add');
    }

    public function submit_add(Request $req)
    {
        $all = $req->all();
        $ins = DepartmentModel::create([
            "name" => $all['name'],
            "description" => $all['description'],
        ]);

        if ($ins) {
            $message = ['status' => 1, 'message' => 'Department Inserted Successfully.'];
        } else {
            $message = ['status' => 0, 'message' => 'Department Inserted Fail'];
        }
        return ($message);
    }


    public function edit($department_id)
    {
        $department = DepartmentModel::find($department_id);
        return view('department.action.edit', ['department' => $department]);

    }
    public function update(Request $req)
    {

        $all = $req->all();
        $department = DepartmentModel::find($all['department_id']);
        $department->name = $all['name'];
        $department->description = $all['description'];
        $upd = $department->save();

        if ($upd) {
            $message = ['status' => 1, 'message' => 'Department Updated Successfully.'];
        } else {
            $message = ['status' => 0, 'message' => 'Department Updated Fail.'];
        }
        return ($message);

    }


    public function destroy($department_id)
    {
        $department = DepartmentModel::find($department_id);
        if ($department) {
            $department->delete();
            $message = ['status' => 1, 'message' => 'Department Deleted Successfully.'];
        } else {
            $message = ['status' => 0, 'message' => 'Department Deleted Fail.'];
        }
        return ($message);

    }

}
