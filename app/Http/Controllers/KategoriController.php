<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index() : View
    {
        $kategori = Kategori::all();
        return view('admin.dashboard.blog.kategori.index', ['kategori' => $kategori]);
    }

    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
        ]);

        Kategori::create([
            'value' => $validated['kategori'],
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function update(Request $request, Kategori $kategori) : RedirectResponse
    {
        $request->validate([
            'kategori' => 'required|string',
        ]);

        $kategori->value = $request->kategori;

        $kategori->save();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori) : RedirectResponse
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
