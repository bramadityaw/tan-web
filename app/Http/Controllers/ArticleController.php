<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index() : View
    {
        $articles = Article::all();
        return view('admin.dashboard.blog.articles.index', ['articles' => $articles]);
    }

    public function create() : View
    {
        $kategori = Kategori::all();
        return view('admin.dashboard.blog.articles.create', ['kategori' => $kategori]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|exists:kategori,id',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=450,max_height=300',
        ]);

        // Handle the file upload if there's a thumbnail
        if ($request->hasFile('thumbnail_url')) {
            $imageName = time() . '.' . $request->thumbnail_url->extension();
            $request->thumbnail_url->move(public_path('/storage/images'), $imageName);
        } else {
            $imageName = null;
        }

        // Create the article
        $article = new Article();
        $article->judul = $request->judul;
        $article->konten = $request->konten;
        $article->thumbnail_url = $imageName;
        $article->kategori_id = $request->kategori;
        $article->save();

        // Return the view with a success message
        return redirect()->route('blog.index')->with('success', 'Article created successfully.');
    }


    public function show(Article $article) : View
    {
        return view('admin.dashboard.blog.articles.show', compact('article'));
    }

    public function edit(Article $article) : View
    {
        return view('admin.dashboard.blog.articles.edit', [
            'article' => $article,
            'kategori' => Kategori::all()
        ]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'kategori' => 'required|exists:kategori,id',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $article->judul = $request->judul;
        $article->konten = $request->konten;
        $article->kategori_id = $request->kategori;

        // Handle the file upload if there's a thumbnail
        if ($request->hasFile('thumbnail_url')) {
            $imageName = time() . '.' . $request->thumbnail_url->extension();
            $request->thumbnail_url->move(public_path('/storage/images'), $imageName);
            $oldImagePath = public_path('/storage/images/') . $article->thumbnail_url;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $article->thumbnail_url = $imageName;
        }

        $article->save();

        // // Redirect to the index page with a success message
        // return redirect()->route('admin.dashboard.blog.index')
        //     ->with('success', 'Article updated successfully.');
        return redirect()->route('blog.index')->with('success', 'Article updated successfully.');

    }

    public function destroy(Article $article) : RedirectResponse
    {
        // Delete the thumbnail image if it exists
        if ($article->thumbnail_url) {
            $imagePath = public_path('/storage/images/') . $article->thumbnail_url;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Delete the article
        $article->delete();

        // Return a redirect with a success message
        return redirect()->route('blog.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
