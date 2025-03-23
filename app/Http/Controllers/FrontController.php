<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Course;
use App\Models\CourseStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category')->get();
        $courses = Course::with('courseCategory')->get();

        return view('pages.front.index', compact('articles', 'courses'));
    }

    public function coursesPage(){
        $courses = Course::with('courseCategory')->get();

        return view('pages.front.courses', compact('courses'));
    }

    public function articlesPage(){
        $articles = Article::with('category')->get();

        return view('pages.front.articles', compact('articles'));
    }

    public function articleDetail($id){
        $article = Article::with('category')->findOrFail($id);
        $articles = Article::with('category')->whereNot('id', $id)->latest()->take(3)->get();

        return view('pages.front.detail-article', compact('article', 'articles'));
    }

    public function courseDetail($id) {
        $course = Course::with('courseCategory')->findOrFail($id);
        $courses = Course::with('courseCategory')->whereNot('id', $id)->latest()->take(3)->get();

        if (Auth::check()) {
            $recordExist = CourseStudent::where('user_id', Auth::user()->id)->exists();

            return view('pages.front.detail-course', compact('course', 'courses', 'recordExist'));
        }

        return view('pages.front.detail-course', compact('course', 'courses'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
