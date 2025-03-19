<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::join('article_categories', 'articles.article_category_id', '=', 'article_categories.id')
            ->select('articles.*', 'article_categories.article_category_name as category_name')
            ->get();

        $categories = ArticleCategory::all();

        return view('pages.article.index', compact('articles', 'categories'));
    }

    public function getOneData(Request $request)
    {
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $course = Article::where('id', $query)->first();
        return response()->json($course);
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

        return redirect()->route('admin.articles.index');
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
    public function update(ArticleUpdateRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $validated = $request->validated();

            $article = Article::findOrFail($id);

            if ($request->hasFile('article_image')) {
                // Delete the old image if it exists
                if ($article->article_image && Storage::disk('public')->exists($article->article_image)) {
                    Storage::disk('public')->delete($article->article_image);
                } 

                // Store the new image
                $validated['article_image'] = $request->file('article_image')->store('images', 'public');
            }

            $article->update($validated);
        });

        return redirect()->route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        DB::transaction(function () use ($article) {
            // Delete the course image if it exists
            if ($article->article_image && Storage::disk('public')->exists($article->article_image)) {
                Storage::disk('public')->delete($article->article_image);
            }

            $article->delete();
        });

        return redirect()->route('admin.articles.index');
    }
}
