<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    public function store(Request $request, $photopostId)
    {
        \Auth::user()->favorite($photopostId);
        return redirect()->back();
    }

    public function destroy($photopostId)
    {
        \Auth::user()->unfavorite($photopostId);
        return redirect()->back();
    }
}
