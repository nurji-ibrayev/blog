<?php

namespace App\Http\Controllers;

use App\Models\ReviewModel;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function reviews()
    {
        $reviews = new ReviewModel();

        return view('reviews', ['reviews' => $reviews->all()]);
    }

    public function review_check(Request $request)
    {
        $validated = $request->validate(
        [
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|min:5|max:255',
            'hide_email' => 'boolean',
            'rating' => 'required|numeric|min:1|max:5',
            'message' => 'required|min:4|max:1000'
        ]);

        $review = new ReviewModel();
        $review->name = $request->input('name');
        $review->email = $request->input('email');
        $review->hide_email = $request->input('hide_email');
        $review->rating = $request->input('rating');
        $review->message = $request->input('message');

        $review->save();

        return redirect('/reviews');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
