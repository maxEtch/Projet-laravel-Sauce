<?php

namespace App\Http\Controllers;

use App\Models\Sauce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SauceLikeController extends Controller
{
    public function like(Sauce $sauce)
    {
        $user = Auth::user();
        $usersLiked = json_decode($sauce->usersLiked ?? '[]', true);
        $usersDisliked = json_decode($sauce->usersDisliked ?? '[]', true);

        if (in_array($user->id, $usersLiked)) {
            $usersLiked = array_diff($usersLiked, [$user->id]);
            $sauce->likes--;
        } else {
            if (($key = array_search($user->id, $usersDisliked)) !== false) {
                unset($usersDisliked[$key]);
                $sauce->dislikes--;
            }

            $usersLiked[] = $user->id;
            $sauce->likes++;
        }

        $sauce->usersLiked = json_encode($usersLiked);
        $sauce->usersDisliked = json_encode($usersDisliked);
        $sauce->save();

        return back()->with('success', 'Like mise à jour');
    }

    public function dislike(Sauce $sauce)
    {
        $user = Auth::user();
        $usersLiked = json_decode($sauce->usersLiked ?? '[]', true);
        $usersDisliked = json_decode($sauce->usersDisliked ?? '[]', true);

        if (in_array($user->id, $usersDisliked)) {
            $usersDisliked = array_diff($usersDisliked, [$user->id]);
            $sauce->dislikes--;
        } else {
            if (($key = array_search($user->id, $usersLiked)) !== false) {
                unset($usersLiked[$key]);
                $sauce->likes--;
            }

            $usersDisliked[] = $user->id;
            $sauce->dislikes++;
        }

        $sauce->usersLiked = json_encode($usersLiked);
        $sauce->usersDisliked = json_encode($usersDisliked);
        $sauce->save();

        return back()->with('success', 'Dislike mise à jour');
    }
}