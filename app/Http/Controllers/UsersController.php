<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; 
use App\Phototo;

class UsersController extends Controller
{
public function index()
    {
        $users = User::paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
 public function show($id)
    {
        $user = User::find($id);
        $photoposts = $user->photoposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'photoposts' => $photoposts,
        ];

         $data += $this->counts($user);

         return view('users.show', $data);
    }
 public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }

}
