<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class AllCategories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();

        return response()->json($categories);
    }

    public function articles(Request $request, $id){

        // get all articles related to a given topic
        $articles = Category::findorfail($id)->articles;
        $headers = [
            'Content-Type' => 'application/json',
            'X-Requested-with' => 'XMLHttpRequest',
        ];
        return response()->json($articles)->withHeaders($headers);
    }

}
