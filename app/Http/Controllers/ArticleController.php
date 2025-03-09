<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // First get the popular articles
        $popularArticles = Article::whereJsonContains('topic', 'popular')
        ->visible()
        ->latest();
    
        // Then get the rest of the articles, excluding those already in popular
        $otherArticles = Article::visible()
            ->latest()
            ->whereNotIn('id', $popularArticles->pluck('id'));
            
        // Combine the queries with a union and paginate the result
        $articles = $popularArticles->union($otherArticles)
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string',
            'slug' => 'required|string|unique:articles',
            'featured_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        Article::create($data);

        return redirect()->route('articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'required|string',
            'slug' => 'required|string|unique:articles,slug,' . $article->id,
            'featured_image' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $article->update($data);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    /** 
     * Show only articles that have the given tag
     */ 
    public function showBySlug($slug)
    {
        $article = Article::where('slug', $slug)
            ->visible()
            ->firstOrFail();

        return view('articles.show', compact('article'));
    }

    /** 
     * Show only articles that have the given tag
     */ 
    public function showByTopic($topic)
    {
        $articles = Article::whereJsonContains('topic', $topic)
            ->visible()
            ->paginate(10);

        return view('articles.index', compact('articles', 'topic'));
    }
}
