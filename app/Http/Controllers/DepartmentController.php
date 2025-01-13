<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\DepartmentModel;


class DepartmentController extends Controller
{

    public function index(){

        $departments = DepartmentModel::all();
        return view('department.index', compact('departments')); 
    }


    public function add(Request $request)
    {
        // try {
        //     // Validate the incoming request
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'nullable|string|max:255',
        //     ]);

        //     // Create a new category
        //     DepartmentModel::create([
        //         'name' => $request->name,
        //         'description' => $request->description,
        //     ]);

        //     // Return success response
        //     return response()->json(['success' => true]);

        // } catch (\Exception $e) {
        //     // Log and return error response
        //     \Log::error('Add Department Error: ' . $e->getMessage());
        //     return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        // }
    
        return view('department.action.add');
        
    }

    public function submit_add(Request $req){
        $all=$req->all();
        $ins = DepartmentModel::create([
            "name" => $all['name'],
            "description" => $all['description'],
            
        ]);

        if($ins){
            $message=['status'=>1,'message'=>'Department Inserted Successfully.'];
        }else{
            $message=['status'=>0,'message'=>'Department Inserted Fail'];
        }
        return ($message);
    }


   
    public function edit($department_id)
    {

        // $category = DepartmentModel::findOrFail($id);
        // return view('categories.edit', compact('category'));

    
        $department=DepartmentModel::find($department_id);
        return view('department.action.edit',['department'=> $department]);
        

    }
    public function update(Request $req)
    {
        // try {
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'nullable|string|max:255',
        //     ]);
        //     $all = $request->all();
        //     $category = DepartmentModel::findOrFail($id);
        //     $category->update([
        //         'name' => $all['name'],
        //         'description' => $all['description'],
        //     ]);

        //     return response()->json(['success' => true, 'message' => 'Department updated successfully']);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        // }


        $all= $req->all();
        $department=DepartmentModel::find($all['department_id']);
        $department->name=$all['name'];
        $department->description=$all['description'];
        $upd=$department->save();
        
        if($upd){
            $message=['status'=>1,'message'=>'Department Updated Successfully.'];
        }else{
            $message=['status'=>0,'message'=>'Department Updated Fail.'];
        }
        return ($message);

    }


    public function destroy($department_id)
    {
        // $category = DepartmentModel::findOrFail($id);
        // $category->delete();

        // return response()->json(['success' => true]);

        $department = DepartmentModel::find($department_id);
        if ($department) {
            $department->delete();
            $message=['status'=>1,'message'=>'Department Deleted Successfully.'];
        }else{
            $message=['status'=>0,'message'=>'Department Deleted Fail.'];
        }
        return ($message);

    }
    
}
