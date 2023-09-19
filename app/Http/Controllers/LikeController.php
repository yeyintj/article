<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    //
    public function __construct() {
        return $this->middleware('auth');
    }

    public function add(Request $request) {
        $userId = auth()->user()->id;
        $articleId = $request->article_id;

        $like = Like::where('user_id', $userId)->where('article_id', $articleId)->exists();

        if($like) {
            Like::where('user_id', $userId)->where('article_id', $articleId)->delete();

            return back();
        } else {
            $like = new Like;
            $like->user_id = $userId;
            $like->article_id = $articleId;
            $like->save();

            return back();
        }

    }
}
