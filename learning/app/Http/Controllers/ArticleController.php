<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\Article as ArticleResource;
//use App\Http\Resources\ArticleCollection;
use App\Http\Traits\DataGetTrait;
use Illuminate\Support\Collection;

class ArticleController extends Controller
{
    use DataGetTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $collections = collect(['sharif','khan',null])->map(function ($val){
//            return strtoupper($val);
//        })->reject(function ($val){
//            return empty($val);
//        });
//        return response()->json($collections);

//        Collection::macro('square',function (){
//            return $this->map(function ($val){
//                return $val * 2;
//            });
//        });

//        $numbers = collect([1,2,3,4]);
//        $s_val = $numbers->square();
//        return response()->json($s_val);
//
//        $keys = collect(['a','b','c']);
//        $vals = ['1','2','3'];
//        $combine = $keys->combine($vals);
//        return response()->json($combine->all());

        $articles = $this->getData(new Article());
        return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->type = $request->input('type');
        $article->description = $request->input('description');
        $article->save();

        return response()->json($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        //$article->title = "NEW titlE";    #learning mutator
        return new ArticleResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->save();
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return response()->json("Deleted");
    }


}
