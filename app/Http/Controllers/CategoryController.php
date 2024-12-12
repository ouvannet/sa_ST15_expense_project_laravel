<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\CategoryModel;


class CategoryController extends Controller
{

    public function index()
    {
        // Fetch categories from the database
        $categories = CategoryModel::all();

        // Return the view with the data
        return view('category.index', compact('categories'));
    }
    public function edit($id)
    {

        $category = CategoryModel::findOrFail($id);
        return view('categories.edit', compact('category'));
    }


    public function store(Request $request)
    {
        try {
            dd($request);
            // Validate the incoming request
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            // Create a new category
            CategoryModel::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            // Return success response
            return response()->json(['success' => true, 'message' => 'Category added successfully']);
        } catch (\Exception $e) {
            // Log and return error response
            \Log::error('Add Category Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }



    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);
            $all = $request->all();
            $category = CategoryModel::findOrFail($id);
            $category->update([
                'name' => $all['name'],
                'description' => $all['description'],
            ]);

            return response()->json(['success' => true, 'message' => 'Category updated successfully']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['success' => false, 'message' => 'Something went wrong'], 500);
        }
    }


    public function destroy($id)
    {
        $category = CategoryModel::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true]);
    }


}
