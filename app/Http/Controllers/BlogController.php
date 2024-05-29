<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use League\CommonMark\CommonMarkConverter;

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
                       "count" => $count,
                       "slug" => $category->slug,
                    ];
                }),
            "articles" => DB::table('articles')
                ->orderBy('updated_at', 'desc')
                ->paginate(4),
            "count" => Article::all()->count(),
            "highlights" => DB::table('articles')->limit(4)->get(),
        ]);
    }

    public function category(Kategori $kategori) : View
    {
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
                       "count" => $count,
                       "slug" => $category->slug,
                    ];
                }),
            "count" => Article::all()->count(),
            "highlights" => DB::table('articles')->limit(4)->get(),
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
            "query_blog"    => $query_string,
            "categories" => DB::table('kategori')
                ->get()
                ->map(function ($category) {
                    $count = Article::where('kategori_id', $category->id)
                        ->get()
                        ->count();
                    return (object) [
                       "value" => $category->value,
                       "count" => $count,
                       "slug" => $category->slug,
                    ];
                }),
            "count" => Article::all()->count(),
            "highlights" => DB::table('articles')->limit(4)->get(),
        ]);
    }

    public function show(Article $article) : View
    {
        $converter = new CommonMarkConverter();
        $konten = $converter->convert($article->konten);

        return view('blog.show', [
            "article" => $article,
            "categories" => DB::table('kategori')
                ->get()
                ->map(function ($category) {
                    $count = Article::where('kategori_id', $category->id)
                        ->get()
                        ->count();
                    return (object) [
                       "value" => $category->value,
                       "count" => $count,
                       "slug" => $category->slug,
                    ];
                }),
            "count" => Article::all()->count(),
            "highlights" => DB::table('articles')->limit(4)->get(),
            "konten" => $konten,
        ]);
    }
    //
}
