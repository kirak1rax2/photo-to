<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function counts($user) {
        $count_photoposts = $user->photoposts()->count();
        $count_followings = $user->followings()->count();
        $count_followers = $user->followers()->count();
        $count_isfavorites = $user->favorites()->count();

        return [
            'count_photoposts' => $count_photoposts,
            'count_followings' => $count_followings,
            'count_followers' => $count_followers,
            'count_isfavorites' => $count_isfavorites,
        ];
    }
}
