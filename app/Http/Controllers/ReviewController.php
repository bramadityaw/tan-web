<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function show(Review $review) : View
    {
        return view('review.show', [
            'review' => $review,
        ]);
    }

    public function create() : View
    {
        return view('review.make');
    }

    public function store(Request $request) : RedirectResponse
    {
        $rules = [
            'nama' => ['required', 'string'],
            'asal_kota' => ['required', 'string'],
            'asal_provinsi' => ['required', 'string'],
            'review' => ['required', 'string'],
        ];

        $validated = $request->validate($rules);

        $review = new Review([
            'nama_pelanggan' => $validated['nama'],
            'review' => $validated['review'],
            'asal_kota' => $validated['asal_kota'],
            'asal_provinsi' => $validated['asal_provinsi'],
        ]);

        if (Auth::check())
        {
            $review->user_id = Auth::user()->id;
        }

        $review->save();

        return redirect()->intended();
    }
}
