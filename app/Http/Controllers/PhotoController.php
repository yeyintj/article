<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Photo;

class PhotoController extends Controller
{

    public function add() {
        $photos = Photo::latest()->get();

        return view('articles.profile', compact('photos'));
    }

    // public function create(Request $request) {
    //     if($request->hasFile('photo')) {
    //         $file = $request->file('photo')->store('photos');
    //         // $fileName = uniqid() . "." . $file->getClientOriginalExtension();
    //         // Photo::create(['path', $file]);
    //     }
    //     $photo = new Photo;
    //     $photo->photo = $file;
    //     $photo->save();

    //     return back();
    // }

    public function store() {

        if(!is_dir(public_path('/photos'))) {
            mkdir(public_path('/photos'), 0777);
        }

        $photo = Collection::wrap(request()->file('photo'));

        $photo->each( function($photo) {
            $basename = Str::random();
            $orginal = $basename. '.' . $photo->getClientOriginalExtension();
            $thumbnail = $basename. '_thumb.' . $photo->getClientOriginalExtension();

            // Photo::make($photo)
            //         ->fit(width: 250, height: 250)
            //         ->save(public_path('/images/' . $thumbnail));
            $photo->move(public_path('/photos'), $orginal);

            Photo::create([
                "profile" => '/photos/' . $orginal,
                "post" => '/photos/' . $thumbnail,
                "user_id" => request()->user_id,
            ]);
        });

        return back();
    }

    public function destroy($id) {

        //database
        $photo = Photo::find($id);
        $photo->delete();

        File::delete([
            public_path($photo->profile),
        ]);

        return back();
    }
}
