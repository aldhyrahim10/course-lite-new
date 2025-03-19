<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCategoryStoreRequest;
use App\Http\Requests\ArticleCategoryUpdateRequest;
use App\Models\ArticleCategory;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articleCategory = ArticleCategory::all();
        return view('pages.article-category.index', compact('articleCategory'));
    }

    public function getOneData(Request $request){
        $request->validate([
            'query' => 'required|integer', 
        ]);
    
        $query = $request->get('query');
        
        $category = ArticleCategory::where('id', $query)->first();
        return response()->json($category);
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
    public function store(ArticleCategoryStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            ArticleCategory::create($request->validated());
        });

        return redirect()->route('admin.article-categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryUpdateRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $articleCategory = ArticleCategory::findOrFail($id);

            $articleCategory->update($request->validated());
        });

        return redirect()->route('admin.article-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            ArticleCategory::findOrFail($id)->delete();
        });

        return redirect()->route('admin.article-categories.index');
    }
}
