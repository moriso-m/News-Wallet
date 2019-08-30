<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Article;
use App\User;

class ArticleController extends Controller
{


    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        //
        $articles = User::findorfail($request->user('api')->id)->articles;
        return response()->json($articles);
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'image',
            'author' => 'string',
            'website' => 'required| url',
            'meta_description' => 'required|string',

        ]);

        $article = Article::create([
            'title' => $validatedData['title'],
            // 'description' => $validatedData['image'],
            'author' => $request->author,
            'website' => $request->website,
            'meta-description' => $request->meta_description,
            'category_id' => $request->category_id,
            'user_id' => $request->user('api')->id,
        ]);

        return response()->json(['success' => 'New articles added']);

    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        //add number of views every time a user views a an article
        $views = $article->views;
        $article->views = $views+1;
        $article->save();

        return response()->json($article);
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $validatedData = $request->validate([
            'title' => 'string',
            'image' => 'image',
            'author' => 'string',
            'website' => 'required|url',
            'meta-description' => 'requred|string',

        ]);

        $article->update([
            'type' => $validatedData['title'],
            // 'description' => $validatedData['image'],
            'author' => $request->author,
            'website' => $request->website,
            'meta-description' => $request->meta_description,
            'user_id' => $request->user('api')->id,
        ]);

        return response()->json(['success' => 'Article updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return response()->json([
            'success' => 'Article has been deleted',
        ]);
    }
}
