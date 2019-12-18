<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Image;
use App\Photo;

class Photocontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos_unsort = Photo::all();
        $photos = array_values(Arr::sort($photos_unsort, function($value){
            return $value['position'];
        }));
        return view('photos', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/photo/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'bail|required|max:255',
            'description' => 'required',
            'position' => 'required',
            'site' => 'required',
            'photo' => 'required'
        ]);
 
         $path = 'storage/';
         $text = $request->photo->extension();
         $fileName = uniqid();
         $original = 'org-' .$fileName.'.'.$text;
         $slide = 'sl-'.$fileName.'.'.$text;
         $thumbnail = 'thumb-' . $fileName .'.'.$text;
         $img = $request->photo;
         $img->storeAs('public', $original);       
         $img->storeAs('public/slider/', $slide); 
         $img->storeAs('public/thumbnail/', $thumbnail); 
         $sl = Image::make(storage_path('app/public/slider/')
         .$slide)->fit(config('photo.image_width'), config('photo.image_height'), null, 'top')->encode('jpg'); 
         $th = Image::make(storage_path('app/public/thumbnail/')
         .$thumbnail)->fit(config('photo.thumbnail_width'), config('photo.thumbnail_height'), null, 'top')->encode('jpg'); 

         $sl->save();
         $th->save();
         $photo = new Photo();
         $photo->title = request('title');
         $photo->description = request('description');
         $photo->visible = request('visible');
         $photo->position = request('position');
         $photo->site = request('site');
         $photo->photo_url = "/slider/".$slide;
         $photo->thumbnail_url = "/storage/thumbnail/".$thumbnail;
         $photo->save(); 
         
         return redirect('/admin/photo/create')->with('status', 'Image "' . $photo->title . ' "  saved'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $photos = Photo::all();
        return view('/admin/photo/show', compact('photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('/admin/photo/edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        {
            $photo = Photo::find($request->id);
            $photo->update([
                'title' => $request->title,
                'description' => $request->description,
                'visible' => $request->visible,
                'position' => $request->position
                ]);
            return redirect('/admin/photo/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        unlink("storage/thumbnail/". basename($photo->thumbnail_url));
        $photo->delete(); 

        return redirect('/admin/photo/show');
    }
}
