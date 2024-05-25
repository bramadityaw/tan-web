<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;


class ArticleController extends Controller
{
    //

    public function index() : View
    {
        // $articles = Article::all();
        //  dd($articles);
        // return view('admin.dashboard.blog.index', [
        //     "articles" => DB::table('articles')->paginate(5)
        // ]);
        $articles = Article::all();
        // dd($articles);
        return view('admin.dashboard.blog.index', ['articles' => $articles]);

    }

    Public function create() : View
    {
        return view('admin.dashboard.blog.create');
    }

    public function store(Request $request)
{
    //Validate the incoming request data
    // dd($request);
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required|string',
        'type' => 'required|in:kategori_1,kategori_2,kategori_3',
        'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle the file upload if there's a thumbnail
    if ($request->hasFile('thumbnail_url')) {
        $imageName = time() . '.' . $request->thumbnail_url->extension();
        $request->thumbnail_url->move(public_path('images1'), $imageName);
    } else {
        $imageName = null;
    }

    // Create the article
    $article = new Article();
    $article->judul = $request->judul;
    $article->konten = $request->konten;
    $article->type = $request->type;
    $article->thumbnail_url = $imageName;
    $article->kategori = $request->type;
    $article->save();

 // Return the view with a success message
    return redirect()->route('blog.index')->with('success', 'Article created successfully.');
//  return view('admin.dashboard.blog.index', ['success' => 'Article created successfully.']);
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'type' => 'required|in:kategori_1,kategori_2,kategori_3',
            'thumbnail_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->judul = $request->judul;
        $article->konten = $request->konten;
        $article->type = $request->type;

        // Handle the file upload if there's a thumbnail
        if ($request->hasFile('thumbnail_url')) {
            $imageName = time() . '.' . $request->thumbnail_url->extension();
            $request->thumbnail_url->move(public_path('images1'), $imageName);
            $article->thumbnail_url = $imageName;
        }

        $article->save();

        // // Redirect to the index page with a success message
        // return redirect()->route('admin.dashboard.blog.index')
        //     ->with('success', 'Article updated successfully.');
        return redirect()->route('blog.index')->with('success', 'Article updated successfully.');

    }


    // public function destroy(int $id) : void
    // {
    //     $article = Article::findOrFail($id);

    //     $storage_path = 'public/' . $article->thumbnail_url;
    //     if (Storage::exists($filePath));
    //     {
    //         Storage::delete($storage_path);
    //         Article::destroy($id);
    //     }

    // }
    // public function destroy($id)
    // {
    //     // Find the article by its ID
    //     //$article = Article::findOrFail($id);
    //     $article = Article::where('id', $id)->first();

    //     // Delete the thumbnail image if it exists
    //     if ($article->thumbnail_url) {
    //         $imagePath = public_path('images1') . '/' . $article->thumbnail_url;
    //         if (file_exists($imagePath)) {
    //             unlink($imagePath);
    //         }
    //     }

    //     // Delete the article
    //     $article->delete();
    //     //return response()->json(['message'=> 'oke']);
    //     // Return a redirect with a success message
    //     return redirect()->route('blog.index')->with('success', 'Artikel berhasil dihapus.');
    // }

    public function destroy($id)
{
    // Find the article by its ID
    $article = Article::findOrFail($id);

    // Delete the thumbnail image if it exists
    if ($article->thumbnail_url) {
        $imagePath = public_path('images1') . '/' . $article->thumbnail_url;
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
