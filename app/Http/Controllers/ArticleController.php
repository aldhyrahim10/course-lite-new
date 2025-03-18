<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = DB::table('articles')
            ->join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')
            ->select('articles.*', 'article_categories.name as category_name')
            ->get();

        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            if ($request->hasFile('article_image')) {
                $validated['article_image'] = $request->file('article_image')->store('images', 'public');
            }
            
            Article::create($validated);
        });

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        DB::transaction(function () use ($request, $article) {
            $validated = $request->validated();

            if ($request->hasFile('article_image')) {
                $validated['article_image'] = $request->file('article_image')->store('images', 'public');
            }

            $article->update($validated);
        });

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        DB::transaction(function () use ($article) {
            $article->delete();
        });

        return redirect()->route('articles.index');
    }
}
