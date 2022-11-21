<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Section;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

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
                        if(!empty($article->section_id)){
                            $article->section = Section::find($article->section_id);
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
        $all = $request->all();
        if($upload_image = FileController::uploadFile($request->file('filename'), "Article", "local")){
            $all['filename'] = $upload_image['image'];
            if(isset($upload_image['compressed']) && !empty($upload_image['compressed'])){
                $all['compressed'] = $upload_image['compressed'];
            }
            if(!empty($all['section_id'])){
                $section = Section::find($all['section_id']);
                if(!empty($section)){
                    $section = $section->section;
                } else {
                    $section = "";
                }
            } else {
                $section = "";
            }
            $release_date = date('l, dS F, Y', strtotime($all['release_date']));
            $all['all_details'] = $all['title'].' '.$all['author'].' '.$all['content'].' '.$section.' '.$release_date;
            if($article = Article::create($all)){
                return response([
                    'status' => 'success',
                    'message' => 'Article added successfully',
                    'data' => $article
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Article Upload Failed'
                ], 500);
            }
        } else {
            $all['filename'] = "";
            $all['compressed'] = "";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if(!empty($article)){
            if(!empty($article->filename)){
                $article->filename = UploadFile::find($article->filename);
            }
            if(!empty($article->compressed)){
                $article->compressed = UploadFile::find($article->compressed);
            }
            if(!empty($article->section_id)){
                $article->section = $article->section_id;
            }

            return response([
                'status' => 'success',
                'message' => 'Article fetched successfully',
                'data' => $article
            ], 200);
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was fetched'
            ], 404);
        }
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
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::find($id);
        if(!empty($article)){
            if(!empty($request->file('filename'))){
                if($upload_image = FileController::uploadFile($request->file('filename'), "Article", "local")){
                    FileController::delete_file($article->filename);
                    FileController::delete_file($article->compressed);

                    $request->filename = $upload_image['image'];
                    if(isset($upload_image['compressed']) && !empty($upload_image['compressed'])){
                        $all['compressed'] = $upload_image['compressed'];
                    }
                }
                $all = $request->all();
                if($article->update($all)){
                    if(!empty($article->section)){
                        if(!empty($section = Section::find($article->section_id))){
                            $section = $section->section;
                        } else {
                            $section = "";
                        }
                    } else {
                        $section = "";
                    }
                    $release_date = date('l, dS F, Y', strtotime($article->release_date));
                    $article->all_details = $article->title.' '.$article->author.' '.$article->content.' '.$section.' '.$release_date;
                    $article->save();

                    return response([
                        'status' => 'success',
                        'message' => 'Article updated successfully',
                        'data' => $article
                    ], 200);
                } else {
                    return response([
                        'status' => 'failed',
                        'message' => 'Could not update Article'
                    ], 500);
                }
            } else {
                unset($request->filename);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was fetched'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if(!empty($article)){
            if($article->delete()){
                FileController::delete_file($article->filename);
                FileController::delete_file($article->compressed);

                return response([
                    'status' => 'success',
                    'message' => 'Article was successfully deleted',
                    'data' => $article
                ], 200);
            } else {
                return response([
                    'status' => 'failed',
                    'message' => 'Article Delete failed'
                ], 500);
            }
        } else {
            return response([
                'status' => 'failed',
                'message' => 'No Article was fetched'
            ], 404);
        }
    }
}
