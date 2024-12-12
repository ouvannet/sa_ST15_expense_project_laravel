<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\DepartmentModel;


class DepartmentController extends Controller
{

    public function index(){

        $departments = DepartmentModel::all();
        //var_dump($users);
        return view('department.index', compact('departments')); 
    }


    public function add(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            // Create a new category
            DepartmentModel::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // Return success response
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Log and return error response
            \Log::error('Add Department Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }
   
    public function edit($id)
    {

        $category = DepartmentModel::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);
            $all = $request->all();
            $category = DepartmentModel::findOrFail($id);
            $category->update([
                'name' => $all['name'],
                'description' => $all['description'],
            ]);

            return response()->json(['success' => true, 'message' => 'Department updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }


    public function destroy($id)
    {
        $category = DepartmentModel::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true]);
    }
    
}
