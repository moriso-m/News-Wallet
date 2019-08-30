<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;

class MostPopularCategories extends Controller
{
    //
    public function popularCategories(Request $request){

    	$average = Category::all()->avg('views');

    	$categories = Category::where('views','>=',$average)->get();

    	return response()->json($categories)->withHeaders(['Content-Type' => 'application/json']);
    }
}
