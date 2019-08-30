<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;

class MostPopularArticles extends Controller
{
    //
    public function popularArticles(Request $request){

    	$average = Article::all()->avg('views');

    	$articles = Article::where('views','>=',$average)->get();

    	return response()->json($articles)->withHeaders(['Content-Type' => 'application/json']);
    }
}
