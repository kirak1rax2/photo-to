<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PhototoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $photoposts = $user->feed_photoposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'photoposts' => $photoposts,
            ];
        }
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->photoposts()->create([
          'content' => $request->content,
        ]);

        return redirect()->back();
    }
    
    public function destroy($id)
    {
      $photopost = \App\Photopost::find($id);

        if (\Auth::id() === $photopost->user_id) {
            $photopost->delete();
         }

        return redirect()->back();
    }
}
