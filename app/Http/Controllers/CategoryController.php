<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CategoryModel;


class CategoryController extends Controller
{

    public function index()
    {
        
        $categories = CategoryModel::all();    
        return view('category.index', compact('categories'));
    }
    // public function edit($id)
    // {
    //     $category = CategoryModel::findOrFail($id);
    //     return view('categories.edit', compact('category'));
    // }

    
    public function edit($category_id){
        $category=CategoryModel::find($category_id);
        return view('category.action.edit',['category'=> $category]);
    }


    public function update(Request $req)
    {
        // try {
    
        //     $request->validate([
        //         'name' => 'required|string|max:255',
        //         'description' => 'nullable|string|max:255',
        //     ]);
        //     $all = $request->all();
        //     $category = CategoryModel::findOrFail($id);
        //     $category->update([
        //         'name' => $all['name'],
        //         'description' => $all['description'],
        //     ]);

        //     return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        // } catch (\Exception $e) {
        //     dd($e);
        //     return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        // }


        $all= $req->all();
        $category=CategoryModel::find($all['category_id']);
        $category->name=$all['name'];
        $category->description=$all['description'];


        $upd=$category->save();
        
        if($upd){
            $message=['status'=>1,'message'=>'Edit Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Edit Permission Failed'];
        }
        return ($message);
    }


    

    // public function add(Request $request)

    // {
    //     try {
    //         // Validate the incoming request
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'description' => 'nullable|string|max:255',
    //         ]);

    //         // Create a new category
    //         CategoryModel::create([
    //             'name' => $request->name,
    //             'description' => $request->description,
    //         ]);

    //         // Return success response
    //         return response()->json(['success' => true]);

    //     } catch (\Exception $e) {
    //         // Log and return error response
    //         \Log::error('Add Category Error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
    //     }
    // }



    public function add(){
        return view('category.action.add');
    }

    public function submit_add(Request $req){
        $all=$req->all();
        $ins = CategoryModel::create([
            "name" => $all['name'],
            "description" => $all['description'],
            
        ]);

        if($ins){
            $message=['status'=>1,'message'=>'Category Inserted Successfully.'];
        }else{
            $message=['status'=>0,'message'=>'Category Inserted Fail'];
        }
        return ($message);
    }



    public function destroy($category_id)
    {

        $category = CategoryModel::find($category_id);
        if ($category) {
            $category->delete();
            $message=['status'=>1,'message'=>'Delete Permission Success'];
        }else{
            $message=['status'=>0,'message'=>'Delete Permission Failed'];
        }
        return ($message);
    }


}
