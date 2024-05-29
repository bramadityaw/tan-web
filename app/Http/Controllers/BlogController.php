<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index() : View
    {
        return view('blog.index', [
            "categories" => DB::table('kategori')
                ->get()
                ->map(function ($category) {
                    $count = Article::where('kategori_id', $category->id)
                        ->get()
                        ->count();
                    return (object) [
                       "value" => $category->value,
                       "count" => $count
                    ];
                }),
            "articles" => DB::table('articles')
                ->orderBy('updated_at', 'desc')
                ->paginate(4),
        ]);
    }

    public function category(Request $request) : View
    {
        $request->validate([
            'kategori' => 'required|exists:kategori,value',
        ]);

        [$kategori] = Kategori::where('value', $request->query->get('kategori'))->get();

        return view('blog.index', [
            "articles" => DB::table('articles')
                ->where('kategori_id', $kategori->id)
                ->orderBy('updated_at', 'desc')
                ->paginate(4),
            "categories" => DB::table('kategori')
                ->get()
                ->map(function ($category) {
                    $count = Article::where('kategori_id', $category->id)
                        ->get()
                        ->count();
                    return (object) [
                       "value" => $category->value,
                       "count" => $count
                    ];
                }),
        ]);
    }

    public function search(Request $request) : View
    {
        $query_string = $request->query->get('query');
        return view('blog.index', [
            "articles" => DB::table('articles')
                       ->whereFullText('konten', $query_string)
                       ->orderBy('updated_at', 'desc')
                       ->paginate(4),
            "query"    => $query_string,
            "categories" => DB::table('kategori')
                ->get()
                ->map(function ($category) {
                    $count = Article::where('kategori_id', $category->id)
                        ->get()
                        ->count();
                    return (object) [
                       "value" => $category->value,
                       "count" => $count
                    ];
                }),
        ]);
    }

    public function show(Article $article) : View
    {
        return view('blog.show', [
            "article" => $article,
            "others" => DB::table('articles')
                    ->where('judul', '!=', $article->judul)
                    ->paginate(4)
        ]);
    }
    //
}
