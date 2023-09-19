<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function create(Request $request) {
        $validator = validator($request->all(),[
            "content" => "required",
            "article_id" => "required",
            // "user_id" => "required",
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $comment = new Comment;
        $comment->content = $request->content;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }

    public function delete($id) {
        $comment = Comment::find($id);

        $comment->delete();
        return back();
    }

    public function update($id, Request $request) {
        $validator = validator($request->all(), [
            'content' => 'required',
        ]);
        if($validator->fails()) {
            return back();
        }
        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();

        return back();
    }
}
