<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\UploadFile;
use Illuminate\Support\Collection;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = !empty($_GET['search']) ? (string)$_GET['search'] : "";
        $limit = !empty($_GET['limit']) ? (string)$_GET['limit'] : "";
        if(!empty($search)){
            $articles = Article::orderBy('created_at', 'desc')->paginate($limit);
            if(!empty($articles)){
                return response([
                    'status' => 'success',
                    'message' => 'Articles fetched successfully',
                    'data' => $articles
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'No Article was found'
                ], 404);
            }
        } else {
            $found = [];
            $search_array = explode(' ', $search);
            foreach($search_array as $search){
                if(($search != 'a') && ($search != 'an') && ($search != 'the') && ($search != 'is') && ($search != 'of') && ($search != 'with')
                && ($search != 'are') && ($search != 'was') && ($search != 'were') && ($search != 'for') && ($search != 'on') && ($search != 'to')
                && ($search != 'on')){
                    $articles = Article::where('all_details', 'like', '%'.$search.'%')->get();
                    if(!empty($articles)){
                        foreach($articles as $article){
                            if(isset($found[$article->id])){
                                $found[$article->id] = $found[$article->id] + 1;
                            } else {
                                $found[$article->id] = 1;
                            }
                        }
                    }
                }            
            }

            if(!empty($found)){
                arsort($found);
                $keys = array_keys($found);
                $articles = [];
                foreach($keys as $id){
                    if(!empty($article = Article::find($id))){
                        $articles[] = $article;
                    }
                }

                if(!empty($articles)){
                    $articles = Collection::make($articles);
                    $articles = $articles->paginate($limit);
                    foreach($articles as $article){
                        if(!empty($article->filename)){
                            $article->filename = UploadFile::find($article->filename);
                        }
                        if(!empty($article->compressed)){
                            $article->compressed = UploadFile::find($article->compressed);
                        }
                    }
                    return response([
                        'status' => 'success',
                        'message' => 'Articles fetched successfully',
                        'data' => $articles
                    ], 200);
                } else {
                    return response([
                        'status' => 'success',
                        'message' => 'No Article was found for "'.$search.'"'
                    ], 404);
                }
            } else {
                return response([
                    'status' => 'success',
                    'message' => 'No Article was fetched for "'.$search.'"'
                ], 404);
            }
        }
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
     * @param  \App\Http\Requests\StoreArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
