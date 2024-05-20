<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = Article::all();
        return view('admin.dashboard.blog.index', compact('articles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_artikel' => 'required|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'required',
            'tanggal_publish' => 'required|date',
        ]);

        Article::create($validatedData);

        return redirect()->route('admin.dashboard.blog.index')
            ->with('success', 'Article created successfully.');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.dashboard.blog.index', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.dashboard.blog.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validatedData = $request->validate([
            'judul_artikel' => 'required|max:150',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kategori' => 'required',
            'tanggal_publish' => 'required|date',
        ]);

        $article->update($validatedData);

        return redirect()->route('admin.dashboard.blog.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.dashboard.blog.index')
            ->with('success', 'Article deleted successfully.');
    }
}
