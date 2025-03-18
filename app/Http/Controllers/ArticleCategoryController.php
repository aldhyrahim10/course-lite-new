<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCategoryStoreRequest;
use App\Http\Requests\ArticleCategoryUpdateRequest;
use App\Models\ArticleCategory;
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
        return view('articleCategory.index', compact('articleCategory'));
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

        return redirect()->route('articleCategory.index');
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
    public function edit(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryUpdateRequest $request, ArticleCategory $articleCategory)
    {
        DB::transaction(function () use ($request, $articleCategory) {
            $articleCategory->update($request->validated());
        });

        return redirect()->route('articleCategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleCategory $articleCategory)
    {
        DB::transaction(function () use ($articleCategory) {
            $articleCategory->delete();
        });

        return redirect()->route('articleCategory.index');
    }
}
