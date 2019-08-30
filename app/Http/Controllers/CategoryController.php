<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    /**
     * Display a listing of the categories.
     */
    public function index(Request $request)
    {
        //fetch all categories
        $categories = User::find($request->user('api')->id)->categories;
        if ($categories) {

            return response()->json($categories);
        }

        return response()->json(['empty' => 'No categories','user' => $request->user('api')]);

    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        Category::create([
            'type' => $validatedData['type'],
            'description' => $validatedData['description'],
            'user_id' => auth('api')->user()->id,
        ]);

        return response()->json(['success' => 'New category added']);
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        //
        // add user to articles_views model
        $views = $category->views;
        $category->views = $views+1;
        $category->save();
        return response()->json($category);
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validatedData = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $category->update([
            'type' => $validatedData['type'],
            'description' => $validatedData['description'],
            'user_id' => $request->user('api')->id,
        ]);

        return response()->json(['success' => 'category has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
        return response()->json([
            'success' => 'Category has been deleted',
        ]);
    }
}
