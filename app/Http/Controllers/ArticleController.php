<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\Category;
use App\Models\Like;

class ArticleController extends Controller
{
    //
    public function __construct() {
        return $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index() {
        $data = Article::latest()->paginate(10);

        return view('articles.index', [
            'articles' => $data,
        ]);
    }

    public function detail($id) {
        $article = Article::find($id);
        // $like = Like::find($id);


        return view('articles.detial', [
            'article' => $article,
            // 'like' => $like,
        ]);
    }

    public function delete($id) {
        $article = Article::find($id);

        if(Gate::allows('article-delete', $article)) {
            $article->delete();
        } else {
            return back()->with('error', 'your not unauthorize to delete');
        }

        return redirect('/articles')->with('info', 'An article was deleted');
    }

    public function edit($id) {
        $data = Article::find($id);
        $category = Category::all();

        return view('articles.edit', [
            'article' => $data,
            'categories' => $category,
        ]);
    }

    public function update($id, Request $request) {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()) {
            return back();
        }

        $article = Article::find($id);

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->save();

        return redirect('/articles');
    }

    public function add() {
        $data = Category::all();

        return view('articles.add', [
            'categories' => $data,
        ]);
    }

    public function create(Request $request) {
        $validator = validator($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            // 'user_id' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect('/articles');
    }
}
