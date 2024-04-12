<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function reviews()
    {
        return view('reviews');
    }

    public function review_check(Request $request)
    {
        $validated = $request->validate(
        [
            'email' => 'required|email|min:5|max:255',
            'subject' => 'required|min:4|max:255',
            'message' => 'required|email|min:4|max:1000'
        ]);
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
